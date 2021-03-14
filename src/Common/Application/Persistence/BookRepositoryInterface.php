<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Application\Persistence;

use Library\Circulation\Common\Domain\Book\Book;
use Library\Circulation\Common\Domain\Book\CallNumber;
use Library\Circulation\Common\Domain\LibraryCard\LibraryCardId;

/**
 * @package Library\Circulation\Common\Application\Persistence
 */
interface BookRepositoryInterface
{
    /**
     * @return \Library\Circulation\Common\Domain\Book\Book
     */
    public function getByLibraryCardId(LibraryCardId $libraryCardId): Book;
}
