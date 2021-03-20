<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\CirculationMaterialReturn\Domain;

use Library\Circulation\Common\Domain\ValueObject\DateTime;

/**
 * @package Library\Circulation\UseCase\CirculationMaterialReturn\Domain
 */
interface CirculationMaterialReturnDataInterface
{
    public function getReturnedAt(): DateTime;
}
