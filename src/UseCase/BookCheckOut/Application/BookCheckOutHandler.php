<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\BookCheckOut\Application;

use Doctrine\DBAL\ConnectionException;
use Doctrine\ORM\EntityManagerInterface;
use Library\Circulation\Common\Application\Date\ClockInterface;
use Library\Circulation\Common\Application\UseCase\UseCaseHandlerInterface;
use Library\Circulation\Core\Book\Application\BookRepositoryInterface;
use Library\Circulation\Core\LibraryCard\Application\LibraryCardPersistenceInterface;
use Library\Circulation\UseCase\BookCheckOut\Domain\BookCheckOutActionInterface;
use Library\Circulation\UseCase\BookCheckOut\Domain\BookCheckOutPolicy;

/**
 * @package Library\Circulation\UseCase\BookCheckOut\Application
 */
class BookCheckOutHandler implements UseCaseHandlerInterface
{
    public function __construct(
        private BookRepositoryInterface $bookRepository,
        private BookCheckOutActionInterface $bookCheckOutAction,
        private BookCheckOutPolicy $bookCheckOutPolicy,
        private LibraryCardPersistenceInterface $libraryCardPersistence,
        private ClockInterface $clock,
        private EntityManagerInterface $entityManager
    ) {
    }

    /**
     * @param \Library\Circulation\UseCase\BookCheckOut\Application\BookCheckOutCommand $command
     * @return void
     * @throws \Library\Circulation\Common\Application\Exception\EntityNotFoundException
     * @throws \Library\Circulation\Core\Book\Domain\Error\ItemsLimitExceededErrorException
     * @throws \Library\Circulation\Core\LibraryCard\Domain\Error\FinancialRulesViolationErrorException
     * @throws \Library\Circulation\Core\LibraryCard\Domain\Error\LibraryMaterialAlreadyBorrowedErrorException
     * @throws \Library\Circulation\Core\LibraryMaterial\Domain\Error\LibraryMaterialNotForCheckOutErrorException
     */
    public function __invoke(BookCheckOutCommand $command): void
    {
        $book = $this->bookRepository->getByLibraryMaterialId($command->getLibraryMaterialId());

        $this->libraryCardPersistence->save(
            $book->checkOut(
                $command,
                $this->bookCheckOutAction,
                $this->bookCheckOutPolicy,
                $this->clock->now(),
            )
        );

        $this->libraryCardPersistence->flush();
    }
}
