<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\BookCheckOut\Domain;

use Library\Circulation\Common\Domain\LibraryCard\LibraryCardLendActionInterface;

interface BookCheckOutActionInterface extends LibraryCardLendActionInterface
{
    public function getAccountBalance(): float;

    public function getAlreadyBorrowedBooksNumber(): int;

    public function getAlreadyOverdueBooksNumber(): int;
}
