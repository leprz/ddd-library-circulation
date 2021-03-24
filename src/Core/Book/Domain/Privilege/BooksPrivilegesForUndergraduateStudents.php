<?php

declare(strict_types=1);

namespace Library\Circulation\Core\Book\Domain\Privilege;

use Library\Circulation\Core\Patron\Domain\PatronType;

class BooksPrivilegesForUndergraduateStudents extends BooksPrivileges
{
    public const LOAN_PERIOD_DAYS = 45;

    public const ITEMS_LIMIT = 10;

    public const ITEMS_OVERDUE_LIMIT = 10;

    public function __construct()
    {
        parent::__construct(PatronType::undergraduateStudent());
    }

    public function getLoanPeriodDays(): int
    {
        return self::LOAN_PERIOD_DAYS;
    }

    public function getItemsLimit(): int
    {
        return self::ITEMS_LIMIT;
    }

    public function getOverdueItemsLimit(): int
    {
        return self::ITEMS_OVERDUE_LIMIT;
    }
}
