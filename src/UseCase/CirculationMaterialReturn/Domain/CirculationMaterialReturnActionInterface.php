<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\CirculationMaterialReturn\Domain;

use Library\Circulation\Common\Domain\ReturnConfirmation\ReturnConfirmationId;

/**
 * @package Library\Circulation\UseCase\CirculationMaterialReturn\Domain
 */
interface CirculationMaterialReturnActionInterface
{
    public function generateNextReturnConfirmationId(): ReturnConfirmationId;
}
