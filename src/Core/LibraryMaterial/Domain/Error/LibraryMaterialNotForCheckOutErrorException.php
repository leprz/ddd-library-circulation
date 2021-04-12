<?php

declare(strict_types=1);

namespace Library\Circulation\Core\LibraryMaterial\Domain\Error;

use Library\Circulation\Common\Domain\Error\DomainErrorException;

class LibraryMaterialNotForCheckOutErrorException extends DomainErrorException
{
    public static function notForOutsideLibraryUse(): self
    {
        return new self("You can borrow this item for in-library use only.");
    }
}
