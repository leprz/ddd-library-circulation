<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\BookCheckOut\Domain;

use Library\Circulation\Common\Domain\Patron\PatronType;
use Library\Circulation\Common\Domain\ValueObject\DateTime;
use Library\Circulation\Common\Domain\ValueObject\DueDate;

interface LibraryCardLoanPolicyInterface
{
    public function calculateLoanDueDate(DateTime $borrowedAt, PatronType $patronType): DueDate;

    public function assertPatronDoNotViolateFinancialRules(float $balance): void;
}