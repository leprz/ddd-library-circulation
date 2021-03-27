<?php

declare(strict_types=1);

namespace Library\Circulation\Core\LibraryMaterial\Domain\Error;

use ErrorException;

class LibraryMaterialNotForCheckOutErrorException extends ErrorException
{
    public static function notForOutsideLibraryUse(): self
    {
        return new self("You can borrow this item for in-library use only.");
    }
}
