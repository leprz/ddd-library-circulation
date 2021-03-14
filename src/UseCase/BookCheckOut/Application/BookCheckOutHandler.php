<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\BookCheckOut\Application;

use Library\Circulation\Common\Application\Date\ClockInterface;
use Library\Circulation\Common\Application\Persistence\BookRepositoryInterface;
use Library\Circulation\Common\Application\Persistence\LibraryCardPersistenceInterface;
use Library\Circulation\UseCase\BookCheckOut\Domain\BookCheckOutActionInterface;
use Library\Circulation\UseCase\BookCheckOut\Domain\BookCheckOutPolicy;

/**
 * @package Library\Circulation\UseCase\BookCheckOut\Application
 */
class BookCheckOutHandler
{
    public function __construct(
        private BookRepositoryInterface $bookRepository,
        private BookCheckOutActionInterface $bookCheckOutAction,
        private BookCheckOutPolicy $bookCheckOutPolicy,
        private LibraryCardPersistenceInterface $libraryCardPersistence,
        private ClockInterface $clock,
    ) {
    }

    /**
     * @param \Library\Circulation\UseCase\BookCheckOut\Application\BookCheckOutCommand $command
     * @return void
     */
    public function __invoke(BookCheckOutCommand $command): void
    {
        $book = $this->bookRepository->getByLibraryCardId($command->getBookLibraryCardId());

        $this->libraryCardPersistence->save(
            $book->checkOut($command, $this->clock->now(), $this->bookCheckOutAction, $this->bookCheckOutPolicy)
        );

        $this->libraryCardPersistence->flush();
    }
}
