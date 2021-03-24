<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\CirculationMaterialReturn\Domain;

use Library\Circulation\Core\LibraryMaterial\Domain\LibraryMaterialId;
use Library\Circulation\Core\Patron\Domain\PatronId;
use Library\Circulation\Core\ReturnConfirmation\Domain\ReturnConfirmation;
use Library\Circulation\Core\ReturnConfirmation\Domain\ReturnConfirmationId;

/**
 * @package Library\Circulation\UseCase\CirculationMaterialReturn\Domain
 */
interface CirculationMaterialReturnActionInterface
{
    public function generateNextReturnConfirmationId(): ReturnConfirmationId;

    public function getLastReturnConfirmationForItem(
        LibraryMaterialId $id,
        PatronId $borrowerId
    ): ReturnConfirmation;
}
