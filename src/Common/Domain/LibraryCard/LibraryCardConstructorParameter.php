<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\LibraryCard;

use Library\Circulation\Common\Domain\Book\CallNumber;
use Library\Circulation\Common\Domain\Patron\PatronId;
use Library\Circulation\Common\Domain\ValueObject\DueDate;

class LibraryCardConstructorParameter implements LibraryCardConstructorParameterInterface
{
    public function libraryCardId(): LibraryCardId
    {
        // TODO: Implement libraryCardId() method.
    }

    public function getBorrowerId(): ?PatronId
    {
        // TODO: Implement getBorrowerId() method.
    }

    public function getDueDate(): ?DueDate
    {
        // TODO: Implement getDueDate() method.
    }

    public function getBookCallNumber(): CallNumber
    {
        // TODO: Implement getBookCallNumber() method.
    }

}
