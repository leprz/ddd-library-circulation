<?php

declare(strict_types=1);

namespace Library\Circulation\Core\Book\Infrastructure;

use Doctrine\ORM\EntityManagerInterface;
use Library\Circulation\Common\Infrastructure\Persistence\EntityMapperTrait;
use Library\Circulation\Core\Book\Domain\Book;

/**
 * @package Library\Circulation\Core\Book\Infrastructure
 */
class BookEntityMapper
{
    use EntityMapperTrait;

    /**
     * @param \Doctrine\ORM\EntityManagerInterface
     */
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    /**
     * @param \Library\Circulation\Core\Book\Infrastructure\BookEntity
     * @param \Library\Circulation\Core\Book\Domain\Book
     * @return \Library\Circulation\Core\Book\Infrastructure\BookEntity
     */
    public function mapToExistingEntity(BookEntity $entity, Book $model): BookEntity
    {
        return $this->mapProperties($model, $entity, $this->entityManager);
    }

    /**
     * @param \Library\Circulation\Core\Book\Domain\Book
     * @return \Library\Circulation\Core\Book\Infrastructure\BookEntity
     */
    public function mapToNewEntity(Book $model): BookEntity
    {
        return $this->mapToExistingEntity($this->createNewInstanceWithoutConstructor(BookEntity::class), $model);
    }
}
