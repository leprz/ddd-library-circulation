<?php

declare(strict_types=1);

namespace Library\Circulation\Core\LibraryCard\Domain;

use Library\Circulation\Common\Domain\DomainEvent\DomainBroadcastEvent;
use Library\Circulation\Common\Domain\LibraryCardReturn\LibraryCardReturnActionInterface;
use Library\Circulation\Common\Domain\LibraryCardReturn\LibraryCardReturnDataInterface;
use Library\Circulation\Common\Domain\LibraryCardReturn\LibraryCardReturnedEvent;
use Library\Circulation\Common\Domain\ValueObject\DateTime;
use Library\Circulation\Common\Domain\ValueObject\DueDate;
use Library\Circulation\Core\LibraryCard\Domain\Error\LibraryMaterialAlreadyBorrowedErrorException;
use Library\Circulation\Core\LibraryMaterial\Domain\LibraryMaterialId;
use Library\Circulation\Core\Patron\Domain\PatronId;
use Library\Circulation\Core\ReturnConfirmation\Domain\ReturnConfirmation;
use Library\SharedKernel\Domain\Event\Circulation\BookCheckedInOverDueEvent;

/**
 * @package Library\Circulation\Core\LibraryCard\Domain
 */
class LibraryCard
{
    private LibraryMaterialId $materialId;

    private ?PatronId $borrowerId;

    private ?DueDate $dueDate;

    /**
     * @param \Library\Circulation\Core\LibraryCard\Domain\LibraryCardConstructorParameterInterface
     */
    protected function __construct(LibraryCardConstructorParameterInterface $data)
    {
        $this->materialId = $data->libraryMaterialId();
        $this->borrowerId = $data->getBorrowerId();
        $this->dueDate = $data->getDueDate();
    }

    public static function register(LibraryMaterialId $libraryMaterialId): self
    {
        return new self(new LibraryCardConstructorParameter($libraryMaterialId));
    }

    /**
     * @param \Library\Circulation\Core\LibraryCard\Domain\LibraryCardLendDataInterface $data
     * @param \Library\Circulation\Common\Domain\ValueObject\DateTime $borrowedAt
     * @param \Library\Circulation\Core\LibraryCard\Domain\LibraryCardLoanPolicyInterface $policy
     * @param \Library\Circulation\Core\LibraryCard\Domain\LibraryCardLendActionInterface $action
     * @return self
     * @throws \Library\Circulation\Core\LibraryCard\Domain\Error\LibraryMaterialAlreadyBorrowedErrorException
     * @throws \Library\Circulation\Core\LibraryCard\Domain\Error\FinancialRulesViolationErrorException
     */
    public function lend(
        LibraryCardLendDataInterface $data,
        LibraryCardLoanPolicyInterface $policy,
        LibraryCardLendActionInterface $action,
        DateTime $borrowedAt,
    ): self {
        if ($this->isLent()) {
            if ($this->isAlreadyLentToTheSameBorrower($data->getBorrowerId())) {
                return $this;
            }

            throw LibraryMaterialAlreadyBorrowedErrorException::create();
        }

        $policy->assertPatronDoNotViolateFinancialRules(
            $action->getAccountBalance($data->getBorrowerId())
        );

        $this->lendUntil(
            $data->getBorrowerId(),
            $policy->calculateLoanDueDate($borrowedAt, $data->getBorrowerType())
        );

        // circulation material lent event
        return $this;
    }

    public function finishLoan(
        LibraryCardReturnDataInterface $data,
        LibraryCardReturnActionInterface $action
    ): ReturnConfirmation {
        if ($this->isAlreadyReturned()) {
            return $action->getLastReturnConfirmation($this->materialId, $data->getBorrowerId());
        }

        $returnConfirmation = ReturnConfirmation::create(
            $action->generateNextReturnConfirmationId(),
            $this->borrowerId,
            $this->materialId,
            $this->dueDate,
            $data->getReturnedAt(),
        );
        
        $action->dispatchInternalEvent(
           new LibraryCardReturnedEvent(
               $this->borrowerId,
               $this->materialId,
               $data->getReturnedAt()->getOverDueTimePeriod($this->dueDate)
           )
        );

        $this->unlockLoan();

        return $returnConfirmation;
    }

    private function isAlreadyReturned(): bool
    {
        return !$this->isLent();
    }

    private function lendUntil(PatronId $borrowerId, DueDate $dueDate): void
    {
        $this->borrowerId = $borrowerId;
        $this->dueDate = $dueDate;
    }

    private function unlockLoan(): void
    {
        $this->borrowerId = null;
        $this->dueDate = null;
    }

    /**
     * @psalm-assert !null $this->borrowerId
     * @psalm-assert !null $this->dueDate
     * @return bool
     */
    protected function isLent(): bool
    {
        return $this->borrowerId !== null && $this->dueDate !== null;
    }

    protected function getDueDate(): ?DueDate
    {
        return $this->dueDate;
    }

    protected function getBorrowerId(): ?PatronId
    {
        return $this->borrowerId;
    }

    /**
     * @param \Library\Circulation\Core\Patron\Domain\PatronId $borrowerId
     * @return bool
     */
    protected function isAlreadyLentToTheSameBorrower(PatronId $borrowerId): bool
    {
        return $this->borrowerId->equals($borrowerId);
    }
}
