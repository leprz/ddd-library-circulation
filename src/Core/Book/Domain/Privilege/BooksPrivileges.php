<?php

declare(strict_types=1);

namespace Library\Circulation\Core\Book\Domain\Privilege;

use Library\Circulation\Core\Patron\Domain\PatronType;

abstract class BooksPrivileges
{
    protected function __construct(private PatronType $patronType)
    {
    }

    public function isAppliedForPatronType(PatronType $patronType): bool
    {
        return $this->patronType->equals($patronType);
    }

    abstract public function getLoanPeriodDays(): int;

    abstract public function getItemsLimit(): int;

    abstract public function getOverdueItemsLimit(): int;
}
