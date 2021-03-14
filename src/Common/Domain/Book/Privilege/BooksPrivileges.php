<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\Book\Privilege;

use Library\Circulation\Common\Domain\Patron\PatronType;

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
