<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\CirculationMaterialReturn\Application;

use Library\Circulation\Common\Application\Persistence\ReturnConfirmation\ReturnConfirmationPersistenceInterface;
use Library\Circulation\Common\Domain\LibraryMaterial\LibraryMaterialId;
use Library\Circulation\Common\Domain\Patron\PatronId;
use Library\Circulation\Common\Domain\ReturnConfirmation\ReturnConfirmation;
use Library\Circulation\Common\Domain\ReturnConfirmation\ReturnConfirmationId;
use Library\Circulation\UseCase\CirculationMaterialReturn\Domain\CirculationMaterialReturnActionInterface;

/**
 * @package Library\Circulation\UseCase\CirculationMaterialReturn\Application
 */
class CirculationMaterialReturnAction implements CirculationMaterialReturnActionInterface
{
    public function __construct(private ReturnConfirmationPersistenceInterface $confirmationPersistence)
    {
    }

    public function generateNextReturnConfirmationId(): ReturnConfirmationId
    {
        return $this->confirmationPersistence->generateNextId();
    }

    public function getLastReturnConfirmationForItem(LibraryMaterialId $id, PatronId $borrowerId): ReturnConfirmation
    {
        // TODO: Implement getLastReturnConfirmationForItem() method.
    }
}
