<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Infrastructure\Persistence\Book;

use Library\Circulation\Common\Domain\Book\Book;
use Library\Circulation\Common\Infrastructure\Entity\BookEntity;
use Library\Circulation\Common\Infrastructure\Persistence\LibraryCard\LibraryCardProxy;

/**
 * @package Library\Circulation\Common\Infrastructure\Persistence\Book
 */
class BookProxy extends Book
{
    /**
     * @param \Library\Circulation\Common\Infrastructure\Entity\BookEntity
     */
    public function __construct(private BookEntity $entity)
    {
        parent::__construct($this->entity, new LibraryCardProxy($this->entity->getLibraryCard()));
    }

    /**
     * @param \Library\Circulation\Common\Infrastructure\Persistence\Book\BookEntityMapper
     * @return \Library\Circulation\Common\Infrastructure\Entity\BookEntity
     */
    public function getEntity(BookEntityMapper $mapper): BookEntity
    {
        return $mapper->mapToExistingEntity($this->entity, $this);
    }
}
