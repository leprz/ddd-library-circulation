<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\CirculationMaterialReturn\Application;

use Library\Circulation\Core\LibraryMaterial\Domain\LibraryMaterialId;
use Library\Circulation\Core\Patron\Domain\PatronId;
use Library\Circulation\Core\ReturnConfirmation\Application\ReturnConfirmationPersistenceInterface;
use Library\Circulation\Core\ReturnConfirmation\Domain\ReturnConfirmation;
use Library\Circulation\Core\ReturnConfirmation\Domain\ReturnConfirmationId;
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
