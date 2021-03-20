<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\CirculationMaterialReturn\Application;

use Library\Circulation\Common\Domain\LibraryMaterial\LibraryMaterialId;
use Library\Circulation\Common\Domain\Patron\PatronId;
use Library\Circulation\Common\Domain\ValueObject\DateTime;
use Library\Circulation\UseCase\CirculationMaterialReturn\Domain\CirculationMaterialReturnDataInterface;

/**
 * @package Library\Circulation\UseCase\CirculationMaterialReturn\Application
 */
class CirculationMaterialReturnCommand implements CirculationMaterialReturnDataInterface
{
    public function __construct(
        private LibraryMaterialId $circulationMaterialId,
        private PatronId $borrowerId,
        private DateTime $returnedAt
    ) {
    }

    public function getReturnedAt(): DateTime
    {
        return $this->returnedAt;
    }

    public function getCirculationMaterialId(): LibraryMaterialId
    {
        return $this->circulationMaterialId;
    }

    public function getBorrowerId(): PatronId
    {
        return $this->borrowerId;
    }
}
