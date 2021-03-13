<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Infrastructure\Persistence\Book;

use Library\Circulation\Common\Application\Persistence\BookRepositoryInterface;
use Library\Circulation\Common\Domain\Book\Book;
use Library\Circulation\Common\Infrastructure\Entity\BookEntity;
use Library\SharedKernel\Infrastructure\Persistence\QueryBuilderTrait;

/**
 * @package Library\Circulation\Common\Infrastructure\Persistence\Book
 */
class BookEntityRepository implements BookRepositoryInterface
{
    use QueryBuilderTrait;

    /**
     * @return string
     */
    protected static function entityClass(): string
    {
        return BookEntity::class;
    }

    /**
     * @return \Library\Circulation\Common\Domain\Book\Book
     */
    public function getById(): Book
    {
    }
}
