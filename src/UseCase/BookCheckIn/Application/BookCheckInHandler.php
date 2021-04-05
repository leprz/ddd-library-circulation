<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\BookCheckIn\Application;

use Library\Circulation\Core\Book\Application\BookRepositoryInterface;

/**
 * @package Library\Circulation\UseCase\BookCheckIn\Application
 */
class BookCheckInHandler
{
    public function __construct(private BookRepositoryInterface $bookRepository)
    {
    }


    /**
     * @param \Library\Circulation\UseCase\BookCheckIn\Application\BookCheckInCommand
     * @return void
     */
    public function __invoke(BookCheckInCommand $command): void
    {
        $this->bookRepository->getByLibraryMaterialId($command->getLibraryMaterialId())
            ->return();
    }
}
