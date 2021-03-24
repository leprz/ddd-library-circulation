<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\BookCheckOut\Application;

use Library\Circulation\Common\Domain\Patron\PatronId;
use Library\Circulation\Common\Financial\Application\PatronFinancialServiceInterface;
use Library\Circulation\UseCase\BookCheckOut\Domain\BookCheckOutActionInterface;

class BookCheckOutAction implements BookCheckOutActionInterface
{
    public function __construct(private PatronFinancialServiceInterface $financialService)
    {
    }

    public function getAccountBalance(PatronId $patronId): float
    {
        return $this->financialService->getBalanceFor($patronId);
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
