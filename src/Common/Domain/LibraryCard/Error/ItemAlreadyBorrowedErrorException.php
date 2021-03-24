<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\LibraryCard\Error;

use ErrorException;

class ItemAlreadyBorrowedErrorException extends ErrorException
{
    public static function create(): self
    {
        return new self("This book is already borrowed.");
    }
}
