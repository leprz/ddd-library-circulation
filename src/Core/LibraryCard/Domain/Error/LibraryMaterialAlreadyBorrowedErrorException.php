<?php

declare(strict_types=1);

namespace Library\Circulation\Core\LibraryCard\Domain\Error;

use Library\Circulation\Common\Domain\Error\DomainErrorException;

class LibraryMaterialAlreadyBorrowedErrorException extends DomainErrorException
{
    public static function create(): self
    {
        return new self("This book is already borrowed.");
    }
}
