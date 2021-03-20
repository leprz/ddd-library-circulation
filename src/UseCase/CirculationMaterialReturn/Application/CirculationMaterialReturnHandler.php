<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\CirculationMaterialReturn\Application;

use Library\Circulation\Common\Application\Persistence\LibraryCardPersistenceInterface;
use Library\Circulation\Common\Application\Persistence\LibraryCardRepositoryInterface;
use Library\Circulation\Common\Application\Persistence\ReturnConfirmation\ReturnConfirmationPersistenceInterface;
use Library\Circulation\UseCase\CirculationMaterialReturn\Domain\CirculationMaterialReturnActionInterface;

/**
 * @package Library\Circulation\UseCase\CirculationMaterialReturn\Application
 */
class CirculationMaterialReturnHandler
{
    public function __construct(
        private LibraryCardRepositoryInterface $libraryCardRepository,
        private CirculationMaterialReturnActionInterface $circulationMaterialReturnAction,
        private ReturnConfirmationPersistenceInterface $confirmationPersistence,
        private LibraryCardPersistenceInterface $libraryCardPersistence
    ) {
    }

    /**
     * @param \Library\Circulation\UseCase\CirculationMaterialReturn\Application\CirculationMaterialReturnCommand
     * @return void
     */
    public function __invoke(CirculationMaterialReturnCommand $command): void
    {
        $libraryCard = $this->libraryCardRepository->getById($command->getCirculationMaterialId());
        $confirmation = $libraryCard->return($command, $this->circulationMaterialReturnAction);

        $this->libraryCardPersistence->save($libraryCard);
        $this->confirmationPersistence->add($confirmation);

        $this->confirmationPersistence->flush();
    }
}