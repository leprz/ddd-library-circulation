<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Application\Persistence;

use Library\Circulation\Common\Domain\Book\Book;
use Library\Circulation\Common\Domain\LibraryMaterial\LibraryMaterialId;

/**
 * @package Library\Circulation\Common\Application\Persistence
 */
interface BookRepositoryInterface
{
    /**
     * @return \Library\Circulation\Common\Domain\Book\Book
     */
    public function getByLibraryCardId(LibraryMaterialId $libraryCardId): Book;

    public function getByISBN(): Book;
}
