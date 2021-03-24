<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\BookCheckOut\Application;

use Library\Circulation\Common\Application\Persistence\BookRepositoryInterface;
use Library\Circulation\Common\Domain\Patron\PatronId;
use Library\Circulation\Common\Financial\Application\PatronFinancialServiceInterface;
use Library\Circulation\Core\Satistics\Application\Persistence\PatronBorrowStatisticsRepositoryInterface;
use Library\Circulation\UseCase\BookCheckOut\Domain\BookCheckOutActionInterface;

class BookCheckOutAction implements BookCheckOutActionInterface
{
    public function __construct(
        private PatronFinancialServiceInterface $financialService,
        private PatronBorrowStatisticsRepositoryInterface $borrowStatisticsRepository
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
