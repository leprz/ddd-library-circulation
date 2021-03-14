<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\BookCheckOut\Application;

use Library\Circulation\UseCase\BookCheckOut\Domain\BookCheckOutActionInterface;

class BookCheckOutAction implements BookCheckOutActionInterface
{
    public function getAccountBalance(): float
    {
        return 0; // TODO: Implement getAccountBalance() method.
    }

    public function getAlreadyBorrowedBooksNumber(): int
    {
        return 0; // TODO: Implement getAlreadyBorrowedBooksNumber() method.
    }

    public function getAlreadyOverdueBooksNumber(): int
    {
        return 0; // TODO: Implement getAlreadyOverdueBooksNumber() method.
    }
}
