<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\BookCheckOut\Domain;

interface BookCheckOutActionInterface
{
    public function getAccountBalance(): float;

    public function getAlreadyBorrowedBooksNumber(): int;

    public function getAlreadyOverdueBooksNumber(): int;
}
