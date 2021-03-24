<?php

declare(strict_types=1);

namespace Library\Circulation\Core\Book\Infrastructure;

use Library\Circulation\Core\Book\Domain\Book;
use Library\Circulation\Core\LibraryCard\Infrastructure\LibraryCardProxy;

/**
 * @package Library\Circulation\Core\Book\Infrastructure
 */
class BookProxy extends Book
{
    /**
     * @param \Library\Circulation\Core\Book\Infrastructure\BookEntity
     */
    public function __construct(private BookEntity $entity)
    {
        parent::__construct($this->entity, new LibraryCardProxy($this->entity->getLibraryCard()));
    }

    /**
     * @param \Library\Circulation\Core\Book\Infrastructure\BookEntityMapper
     * @return \Library\Circulation\Core\Book\Infrastructure\BookEntity
     */
    public function getEntity(BookEntityMapper $mapper): BookEntity
    {
        return $mapper->mapToExistingEntity($this->entity, $this);
    }
}
