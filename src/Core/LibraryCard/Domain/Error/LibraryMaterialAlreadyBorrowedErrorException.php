<?php

declare(strict_types=1);

namespace Library\Circulation\Core\LibraryCard\Domain\Error;

use ErrorException;

class LibraryMaterialAlreadyBorrowedErrorException extends ErrorException
{
    public static function create(): self
    {
        return new self("This book is already borrowed.");
    }
}
