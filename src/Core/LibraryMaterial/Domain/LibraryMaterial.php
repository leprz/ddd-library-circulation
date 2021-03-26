<?php

declare(strict_types=1);

namespace Library\Circulation\Core\LibraryMaterial\Domain;

use Library\Circulation\Common\Domain\ValueObject\DateTime;
use Library\Circulation\Core\LibraryCard\Domain\LibraryCard;
use Library\Circulation\Core\LibraryCard\Domain\LibraryCardLendActionInterface;
use Library\Circulation\Core\LibraryMaterial\Domain\Error\LibraryMaterialBorrowErrorException;
use Library\Circulation\UseCase\BookCheckOut\Domain\LibraryCardLendDataInterface;
use Library\Circulation\UseCase\BookCheckOut\Domain\LibraryCardLoanPolicyInterface;

abstract class LibraryMaterial
{
    public function __construct(private bool $inLibraryUseOnly, private LibraryCard $libraryCard)
    {
    }

    /**
     * @param bool $forCheckOut
     * @param \Library\Circulation\UseCase\BookCheckOut\Domain\LibraryCardLendDataInterface $data
     * @param \Library\Circulation\UseCase\BookCheckOut\Domain\LibraryCardLoanPolicyInterface $policy
     * @param \Library\Circulation\Core\LibraryCard\Domain\LibraryCardLendActionInterface $action
     * @param \Library\Circulation\Common\Domain\ValueObject\DateTime $borrowedAt
     * @return \Library\Circulation\Core\LibraryCard\Domain\LibraryCard
     * @throws \Library\Circulation\Core\Book\Domain\Error\BorrowLimitExceededErrorException
     * @throws \Library\Circulation\Core\LibraryCard\Domain\Error\ItemAlreadyBorrowedErrorException
     * @throws \Library\Circulation\Core\LibraryMaterial\Domain\Error\LibraryMaterialBorrowErrorException
     */
    protected function lend(
        bool $forCheckOut,
        LibraryCardLendDataInterface $data,
        LibraryCardLoanPolicyInterface $policy,
        LibraryCardLendActionInterface $action,
        DateTime $borrowedAt,
    ): LibraryCard {
        if ($forCheckOut === true) {
            $this->assertCanBeUsedOutsideLibrary();
        }

        $policy->assertPatronHasReachedItemsLimit(
            $data->getBorrowerType(),
            $action->getAlreadyBorrowedItemsNumber($data->getBorrowerId()),
            $action->getAlreadyOverdueItemsNumber($data->getBorrowerId())
        );

        return $this->libraryCard->lend($data, $policy, $action, $borrowedAt);
    }

    /**
     * @return void
     * @throws \Library\Circulation\Core\LibraryMaterial\Domain\Error\LibraryMaterialBorrowErrorException
     */
    protected function assertCanBeUsedOutsideLibrary(): void
    {
        if ($this->inLibraryUseOnly === true) {
            throw LibraryMaterialBorrowErrorException::notForOutsideLibraryUse();
        }
    }
}