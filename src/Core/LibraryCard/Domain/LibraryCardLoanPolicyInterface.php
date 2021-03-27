<?php

declare(strict_types=1);

namespace Library\Circulation\Core\LibraryCard\Domain;

use Library\Circulation\Common\Domain\ValueObject\DateTime;
use Library\Circulation\Common\Domain\ValueObject\DueDate;
use Library\Circulation\Core\Patron\Domain\PatronType;

interface LibraryCardLoanPolicyInterface
{
    public function calculateLoanDueDate(DateTime $borrowedAt, PatronType $patronType): DueDate;

    /**
     * @param \Library\Circulation\Core\Patron\Domain\PatronType $patronType
     * @param int $alreadyBorrowedItemsNumber
     * @param int $alreadyOverdueItemsNumber
     * @throws \Library\Circulation\Core\Book\Domain\Error\ItemsLimitExceededErrorException
     */
    public function assertPatronHasReachedItemsLimit(
        PatronType $patronType,
        int $alreadyBorrowedItemsNumber,
        int $alreadyOverdueItemsNumber
    ): void;

    /**
     * @param float $balance
     * @throws \Library\Circulation\Core\LibraryCard\Domain\Error\FinancialRulesViolationErrorException
     */
    public function assertPatronDoNotViolateFinancialRules(float $balance): void;
}
