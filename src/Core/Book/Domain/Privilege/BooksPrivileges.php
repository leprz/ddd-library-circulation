<?php

declare(strict_types=1);

namespace Library\Circulation\Core\Book\Domain\Privilege;

use Library\Circulation\Common\Domain\Privilege\LibraryMaterialPrivilege;
use Library\Circulation\Core\Patron\Domain\PatronType;

abstract class BooksPrivileges extends LibraryMaterialPrivilege
{
    protected function __construct(private PatronType $patronType)
    {
    }

    public function isAppliedForPatronType(PatronType $patronType): bool
    {
        return $this->patronType->equals($patronType);
    }

    abstract public function getLoanPeriodDays(): int;
}
