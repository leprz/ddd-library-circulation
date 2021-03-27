<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\Privilege;

abstract class LibraryMaterialPrivilege
{
    abstract public function getItemsLimit(): int;

    abstract public function getOverdueItemsLimit(): int;
}
