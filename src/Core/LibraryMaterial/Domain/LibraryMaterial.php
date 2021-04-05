<?php

declare(strict_types=1);

namespace Library\Circulation\Core\LibraryMaterial\Domain;

use Library\Circulation\Common\Domain\LibraryCardReturn\LibraryCardReturnActionInterface;
use Library\Circulation\Common\Domain\LibraryCardReturn\LibraryCardReturnDataInterface;
use Library\Circulation\Common\Domain\ValueObject\DateTime;
use Library\Circulation\Core\LibraryCard\Domain\LibraryCard;
use Library\Circulation\Core\LibraryCard\Domain\LibraryCardLendActionInterface;
use Library\Circulation\Core\LibraryCard\Domain\LibraryCardLendDataInterface;
use Library\Circulation\Core\LibraryCard\Domain\LibraryCardLoanPolicyInterface;
use Library\Circulation\Core\LibraryMaterial\Domain\Error\LibraryMaterialNotForCheckOutErrorException;
use Library\Circulation\Core\ReturnConfirmation\Domain\ReturnConfirmation;

abstract class LibraryMaterial
{
    public function __construct(private bool $inLibraryUseOnly, private LibraryCard $libraryCard)
    {
    }

    /**
     * @param \Library\Circulation\Common\Domain\LibraryCardReturn\LibraryCardReturnDataInterface $data
     * @param \Library\Circulation\Common\Domain\LibraryCardReturn\LibraryCardReturnActionInterface $action
     * @return \Library\Circulation\Core\ReturnConfirmation\Domain\ReturnConfirmation
     */
    protected function returnLibraryCard(
        LibraryCardReturnDataInterface $data,
        LibraryCardReturnActionInterface $action
    ): ReturnConfirmation {
        $returnConfirmation = $this->libraryCard->finishLoan($data, $action);
        $action->saveLibraryCard($this->libraryCard);

        return $returnConfirmation;
    }

    /**
     * @param \Library\Circulation\Core\LibraryCard\Domain\LibraryCardLendDataInterface $data
     * @param \Library\Circulation\Core\LibraryCard\Domain\LibraryCardLoanPolicyInterface $policy
     * @param \Library\Circulation\Core\LibraryCard\Domain\LibraryCardLendActionInterface $action
     * @param \Library\Circulation\Common\Domain\ValueObject\DateTime $borrowedAt
     * @return \Library\Circulation\Core\LibraryCard\Domain\LibraryCard
     * @throws \Library\Circulation\Core\Book\Domain\Error\ItemsLimitExceededErrorException
     * @throws \Library\Circulation\Core\LibraryCard\Domain\Error\FinancialRulesViolationErrorException
     * @throws \Library\Circulation\Core\LibraryCard\Domain\Error\LibraryMaterialAlreadyBorrowedErrorException
     */
    protected function lendLibraryCard(
        LibraryCardLendDataInterface $data,
        LibraryCardLoanPolicyInterface $policy,
        LibraryCardLendActionInterface $action,
        DateTime $borrowedAt,
    ): LibraryCard {
        $policy->assertPatronHasReachedItemsLimit(
            $data->getBorrowerType(),
            $action->getAlreadyBorrowedItemsNumber($data->getBorrowerId()),
            $action->getAlreadyOverdueItemsNumber($data->getBorrowerId())
        );

        return $this->libraryCard->lend($data, $policy, $action, $borrowedAt);
    }

    /**
     * @return void
     * @throws \Library\Circulation\Core\LibraryMaterial\Domain\Error\LibraryMaterialNotForCheckOutErrorException
     */
    protected function assertCanBeUsedOutsideLibrary(): void
    {
        if ($this->inLibraryUseOnly === true) {
            throw LibraryMaterialNotForCheckOutErrorException::notForOutsideLibraryUse();
        }
    }
}
