<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\LibraryCard;

use Library\Circulation\Common\Domain\LibraryCard\Error\ItemAlreadyBorrowedErrorException;
use Library\Circulation\Common\Domain\LibraryMaterial\LibraryMaterialId;
use Library\Circulation\Common\Domain\Patron\PatronId;
use Library\Circulation\Common\Domain\ReturnConfirmation\ReturnConfirmation;
use Library\Circulation\Common\Domain\ValueObject\DateTime;
use Library\Circulation\Common\Domain\ValueObject\DueDate;
use Library\Circulation\UseCase\BookCheckOut\Domain\LibraryCardLendDataInterface;
use Library\Circulation\UseCase\BookCheckOut\Domain\LibraryCardLoanPolicyInterface;
use Library\Circulation\UseCase\CirculationMaterialReturn\Domain\CirculationMaterialReturnActionInterface;
use Library\Circulation\UseCase\CirculationMaterialReturn\Domain\CirculationMaterialReturnDataInterface;

/**
 * @package Library\Circulation\Common\Domain\LibraryCard
 */
class LibraryCard
{
    private LibraryMaterialId $id;

    private ?PatronId $borrowerId;

    private ?DueDate $dueDate;

    /**
     * @param \Library\Circulation\Common\Domain\LibraryCard\LibraryCardConstructorParameterInterface
     */
    protected function __construct(LibraryCardConstructorParameterInterface $data)
    {
        $this->id = $data->libraryMaterialId();
        $this->borrowerId = $data->getBorrowerId();
        $this->dueDate = $data->getDueDate();
    }

    public static function register(LibraryMaterialId $libraryMaterialId): self
    {
        return new self(new LibraryCardConstructorParameter($libraryMaterialId));
    }

    /**
     * @param \Library\Circulation\UseCase\BookCheckOut\Domain\LibraryCardLendDataInterface $data
     * @param \Library\Circulation\Common\Domain\ValueObject\DateTime $borrowedAt
     * @param \Library\Circulation\UseCase\BookCheckOut\Domain\LibraryCardLoanPolicyInterface $policy
     * @param \Library\Circulation\Common\Domain\LibraryCard\LibraryCardLendActionInterface $action
     * @return self
     * @throws \Library\Circulation\Common\Domain\LibraryCard\Error\ItemAlreadyBorrowedErrorException
     */
    public function lend(
        LibraryCardLendDataInterface $data,
        DateTime $borrowedAt,
        LibraryCardLoanPolicyInterface $policy,
        LibraryCardLendActionInterface $action
    ): self {
        if ($this->isLent()) {
            if ($this->isAlreadyLentToTheSameBorrower($data->getBorrowerId())) {
                return $this;
            }

            throw ItemAlreadyBorrowedErrorException::create();
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

    public function return(
        CirculationMaterialReturnDataInterface $data,
        CirculationMaterialReturnActionInterface $action
    ): ReturnConfirmation {
        if ($this->isAlreadyReturned()) {
            return $action->getLastReturnConfirmationForItem($this->id, $this->borrowerId);
        }

        $returnConfirmation = ReturnConfirmation::create(
            $action->generateNextReturnConfirmationId(),
            $this->borrowerId,
            $this->id,
            $this->dueDate,
            $data->getReturnedAt(),
        );

        $this->unlockLoan();

        // CirculationMaterialReturnedEvent

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
    private function isLent(): bool
    {
        return $this->borrowerId !== null && $this->dueDate !== null;
    }

    protected function getDueDate(): DueDate
    {
        return $this->dueDate;
    }

    protected function getBorrowerId(): ?PatronId
    {
        return $this->borrowerId;
    }

    /**
     * @param \Library\Circulation\Common\Domain\Patron\PatronId $borrowerId
     * @return bool
     */
    protected function isAlreadyLentToTheSameBorrower(PatronId $borrowerId): bool
    {
        return $this->borrowerId->equals($borrowerId);
    }
}
