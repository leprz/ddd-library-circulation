<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\OtherMaterialCheckOut\Application;

use Library\Circulation\Core\Finance\Application\FinanceServiceInterface;
use Library\Circulation\Core\OtherMaterial\Domain\OtherMaterialType;
use Library\Circulation\Core\Satistics\Application\PatronBorrowedOtherMaterialsStatisticsRepositoryInterface;
use Library\Circulation\UseCase\OtherMaterialCheckOut\Domain\OtherMaterialCheckOutActionBuilderInterface;
use Library\Circulation\UseCase\OtherMaterialCheckOut\Domain\OtherMaterialCheckOutActionInterface;

class OtherMaterialCheckOutActionBuilder implements OtherMaterialCheckOutActionBuilderInterface
{
    public function __construct(
        private FinanceServiceInterface $financeService,
        private PatronBorrowedOtherMaterialsStatisticsRepositoryInterface $otherMaterialsStatisticsRepository
    ) {
    }

    public function getAction(OtherMaterialType $materialType): OtherMaterialCheckOutActionInterface
    {
        return new OtherMaterialCheckOutAction(
            $materialType,
            $this->financeService,
            $this->otherMaterialsStatisticsRepository
        );
    }
}
