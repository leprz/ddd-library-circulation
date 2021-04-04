<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\BookCheckIn\Application;

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
}
