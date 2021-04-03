<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\OtherMaterialUseInLibrary\Application;

use Library\Circulation\Core\Finance\Application\FinanceServiceInterface;
use Library\Circulation\Core\OtherMaterial\Domain\OtherMaterialType;
use Library\Circulation\Core\Satistics\Application\PatronBorrowedOtherMaterialsStatisticsRepositoryInterface;
use Library\Circulation\UseCase\OtherMaterialCheckOut\Domain\OtherMaterialCheckOutActionBuilderInterface;
use Library\Circulation\UseCase\OtherMaterialCheckOut\Domain\OtherMaterialCheckOutActionInterface;
use Library\Circulation\UseCase\OtherMaterialUseInLibrary\Domain\OtherMaterialUseInLibraryActionBuilderInterface;
use Library\Circulation\UseCase\OtherMaterialUseInLibrary\Domain\OtherMaterialUseInLibraryActionInterface;

class OtherMaterialUseInLibraryActionBuilder implements OtherMaterialUseInLibraryActionBuilderInterface
{
    public function __construct(
        private FinanceServiceInterface $financeService,
        private PatronBorrowedOtherMaterialsStatisticsRepositoryInterface $otherMaterialsStatisticsRepository
    ) {
    }

    public function getAction(OtherMaterialType $materialType): OtherMaterialUseInLibraryActionInterface
    {
        return new OtherMaterialUseInLibraryAction(
            $materialType,
            $this->financeService,
            $this->otherMaterialsStatisticsRepository
        );
    }
}
