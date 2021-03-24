<?php

declare(strict_types=1);

namespace Library\Circulation\Core\Book\Domain\Privilege;

use Library\Circulation\Core\Patron\Domain\PatronType;

class BooksPrivilegesForGraduateStudents extends BooksPrivileges
{
    public const LOAN_PERIOD_DAYS = 120;

    public const ITEMS_LIMIT = 125;

    public const ITEMS_OVERDUE_LIMIT = 25;

    public function __construct()
    {
        parent::__construct(PatronType::graduateStudent());
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
