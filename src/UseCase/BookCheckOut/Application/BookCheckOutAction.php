<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\BookCheckOut\Application;

use Library\Circulation\Core\Finance\Application\FinanceServiceInterface;
use Library\Circulation\Core\Patron\Domain\PatronId;
use Library\Circulation\Core\Satistics\Application\PatronBorrowedBooksStatisticsRepositoryInterface;
use Library\Circulation\UseCase\BookCheckOut\Domain\BookCheckOutActionInterface;

class BookCheckOutAction implements BookCheckOutActionInterface
{
    public function __construct(
        private FinanceServiceInterface $financialService,
        private PatronBorrowedBooksStatisticsRepositoryInterface $borrowStatisticsRepository
    ) {
    }

    public function getAccountBalance(PatronId $patronId): float
    {
        return $this->financialService->getBalanceFor($patronId);
    }

    public function getAlreadyBorrowedItemsNumber(PatronId $patronId): int
    {
        return $this->borrowStatisticsRepository->countBorrowedBy($patronId);
    }

    public function getAlreadyOverdueItemsNumber(PatronId $patronId): int
    {
        return $this->borrowStatisticsRepository->countBorrowedOverdueBy($patronId);
    }
}
