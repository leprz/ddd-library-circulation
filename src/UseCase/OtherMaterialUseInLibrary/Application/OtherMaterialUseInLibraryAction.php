<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\OtherMaterialUseInLibrary\Application;

use Library\Circulation\Core\Finance\Application\FinanceServiceInterface;
use Library\Circulation\Core\OtherMaterial\Domain\OtherMaterialType;
use Library\Circulation\Core\Patron\Domain\PatronId;
use Library\Circulation\Core\Satistics\Application\PatronBorrowedOtherMaterialsStatisticsRepositoryInterface;
use Library\Circulation\UseCase\OtherMaterialUseInLibrary\Domain\OtherMaterialUseInLibraryActionInterface;

/**
 * @package Library\Circulation\UseCase\OtherMaterialUseInLibrary\Application
 */
class OtherMaterialUseInLibraryAction implements OtherMaterialUseInLibraryActionInterface
{
    public function __construct(
        private OtherMaterialType $materialType,
        private FinanceServiceInterface $financeService,
        private PatronBorrowedOtherMaterialsStatisticsRepositoryInterface $otherMaterialStatistics
    ) {
    }

    public function getAccountBalance(PatronId $patronId): float
    {
        return $this->financeService->getBalanceFor($patronId);
    }

    public function getAlreadyBorrowedItemsNumber(PatronId $patronId): int
    {
        return $this->otherMaterialStatistics->countBorrowedBy($patronId, $this->materialType);
    }

    public function getAlreadyOverdueItemsNumber(PatronId $patronId): int
    {
        return $this->otherMaterialStatistics->countBorrowedOverdueBy($patronId, $this->materialType);
    }
}
