<?php

declare(strict_types=1);

namespace Library\Circulation\Core\Satistics\Application;

use Library\Circulation\Core\OtherMaterial\Domain\OtherMaterialType;
use Library\Circulation\Core\Patron\Domain\PatronId;

interface PatronBorrowedOtherMaterialsStatisticsRepositoryInterface
{
    public function countBorrowedBy(PatronId $patronId, OtherMaterialType $materialType): int;

    public function countBorrowedOverdueBy(PatronId $patronId, OtherMaterialType $materialType): int;
}
