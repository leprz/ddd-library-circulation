<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\Book\Privilege;

use Library\Circulation\Common\Domain\Patron\PatronType;

class BooksPrivilegesForFaculty extends BooksPrivileges
{
    public const LOAN_PERIOD_DAYS = 120;

    public const ITEMS_LIMIT = 500;

    public const ITEMS_OVERDUE_LIMIT = 50;

    public function __construct()
    {
        parent::__construct(PatronType::faculty());
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
