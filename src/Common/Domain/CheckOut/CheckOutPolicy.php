<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\CheckOut;

use Library\Circulation\Core\LibraryCard\Domain\Error\FinancialRulesViolationErrorException;
use Library\Circulation\Core\LibraryCard\Domain\LibraryCardLoanPolicyInterface;

abstract class CheckOutPolicy implements LibraryCardLoanPolicyInterface
{
    /**
     * @param float $balance
     * @throws \Library\Circulation\Core\LibraryCard\Domain\Error\FinancialRulesViolationErrorException
     */
    public function assertPatronDoNotViolateFinancialRules(float $balance): void
    {
        if ($balance < 0) {
            throw FinancialRulesViolationErrorException::balanceIsToLow();
        }
    }
}
