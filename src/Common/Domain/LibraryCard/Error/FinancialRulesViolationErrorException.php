<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\LibraryCard\Error;

use Library\Circulation\Common\Domain\Error\DomainErrorException;

class FinancialRulesViolationErrorException extends DomainErrorException
{
    public static function balanceIsToLow(): self
    {
        return new self("Please pay your fees before you borrow another book.");
    }
}
