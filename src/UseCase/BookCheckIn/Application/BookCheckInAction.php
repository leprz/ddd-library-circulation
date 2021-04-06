<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\BookCheckIn\Application;

use Library\Circulation\Common\Domain\DomainEvent\DomainBroadcastEvent;
use Library\Circulation\Common\Domain\DomainEvent\DomainEventBus;
use Library\Circulation\Common\Domain\DomainEvent\DomainEventDispatcher;
use Library\Circulation\Core\LibraryCard\Application\LibraryCardPersistenceInterface;
use Library\Circulation\Core\LibraryCard\Domain\LibraryCard;
use Library\Circulation\Core\LibraryMaterial\Domain\LibraryMaterialId;
use Library\Circulation\Core\Patron\Domain\PatronId;
use Library\Circulation\Core\ReturnConfirmation\Application\ReturnConfirmationPersistenceInterface;
use Library\Circulation\Core\ReturnConfirmation\Application\ReturnConfirmationRepositoryInterface;
use Library\Circulation\Core\ReturnConfirmation\Domain\ReturnConfirmation;
use Library\Circulation\Core\ReturnConfirmation\Domain\ReturnConfirmationId;
use Library\Circulation\UseCase\BookCheckIn\Domain\BookCheckInActionInterface;

/**
 * @package Library\Circulation\UseCase\BookCheckIn\Application
 */
class BookCheckInAction implements BookCheckInActionInterface
{
    public function __construct(
        private ReturnConfirmationPersistenceInterface $returnConfirmationPersistence,
        private ReturnConfirmationRepositoryInterface $returnConfirmationRepository,
        private LibraryCardPersistenceInterface $libraryCardPersistence,
        private DomainEventBus $eventBus,
    ) {
    }

    public function generateNextReturnConfirmationId(): ReturnConfirmationId
    {
        return $this->returnConfirmationPersistence->generateNextId();
    }

    public function getLastReturnConfirmation(LibraryMaterialId $id, PatronId $borrowerId): ReturnConfirmation
    {
        return $this->returnConfirmationRepository->getLastReturnConfirmation($id, $borrowerId);
    }

    public function saveLibraryCard(LibraryCard $libraryCard): void
    {
        $this->libraryCardPersistence->save($libraryCard);
    }

    public function dispatchGlobalEvent(object $event, string $emitter): void
    {
        $this->eventBus->dispatch(
            new DomainBroadcastEvent(
                $event,
                $emitter
            )
        );
    }

    public function dispatchInternalEvent(object $event): void
    {
        $this->eventBus->dispatch($event);
    }

    public function subscribeEvent(string $class, callable $callable): void
    {
        $this->eventBus->subscribe($class, $callable);
    }
}
