<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Infrastructure\Persistence\Book;

use Library\Circulation\Common\Domain\Book\Book;
use Library\Circulation\Common\Infrastructure\Entity\BookEntity;

/**
 * @package Library\Circulation\Common\Infrastructure\Persistence\Book
 */
class BookProxy extends Book
{
    /**
     * @param \Library\Circulation\Common\Infrastructure\Entity\BookEntity
     */
    public function __construct(BookEntity $entity)
    {
    }

    /**
     * @param \Library\Circulation\Common\Infrastructure\Persistence\Book\BookEntityMapper
     * @return \Library\Circulation\Common\Infrastructure\Entity\BookEntity
     */
    public function getEntity(BookEntityMapper $mapper): BookEntity
    {
    }
}
