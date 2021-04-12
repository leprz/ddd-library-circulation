<?php

declare(strict_types=1);

namespace Library\Circulation\Core\Book\Application;

use Library\Circulation\Core\Book\Domain\Book;
use Library\Circulation\Core\LibraryMaterial\Domain\LibraryMaterialId;

/**
 * @package Library\Circulation\Common\Application\Persistence
 */
interface BookRepositoryInterface
{
    /**
     * @param \Library\Circulation\Core\LibraryMaterial\Domain\LibraryMaterialId $libraryCardId
     * @return \Library\Circulation\Core\Book\Domain\Book
     * @throws \Library\Circulation\Common\Application\Exception\EntityNotFoundException
     */
    public function getByLibraryMaterialId(LibraryMaterialId $libraryCardId): Book;

    public function getByISBN(): Book;
}
