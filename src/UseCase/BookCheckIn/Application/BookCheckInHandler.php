<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\BookCheckIn\Application;

use Library\Circulation\Common\Domain\DomainEvent\DomainEventStore;
use Library\Circulation\Core\Book\Application\BookPersistenceInterface;
use Library\Circulation\Core\Book\Application\BookRepositoryInterface;
use Library\Circulation\Core\ReturnConfirmation\Application\ReturnConfirmationPersistenceInterface;
use Library\Circulation\Core\ReturnConfirmation\Application\ReturnConfirmationRepositoryInterface;
use Library\Circulation\UseCase\BookCheckIn\Domain\BookCheckInActionInterface;

/**
 * @package Library\Circulation\UseCase\BookCheckIn\Application
 */
class BookCheckInHandler
{
    public function __construct(
        private BookRepositoryInterface $bookRepository,
        private BookCheckInActionInterface $action,
        private BookPersistenceInterface $bookPersistence,
        private ReturnConfirmationPersistenceInterface $returnConfirmationPersistence,
        private ReturnConfirmationRepositoryInterface $returnConfirmationRepository,
        private DomainEventStore $eventStore
    ) {
    }


    /**
     * @param \Library\Circulation\UseCase\BookCheckIn\Application\BookCheckInCommand
     * @return void
     */
    public function __invoke(BookCheckInCommand $command): void
    {
        $book = $this->bookRepository->getByLibraryMaterialId(
            $command->getLibraryMaterialId()
        );

        $returnConfirmation = $book->checkIn($command, $this->action);

        $this->bookPersistence->save($book);

        if (!$returnConfirmation->exists($this->returnConfirmationRepository)) {
            $this->returnConfirmationPersistence->add($returnConfirmation);
        }

        $this->bookPersistence->flush();
    }
}
