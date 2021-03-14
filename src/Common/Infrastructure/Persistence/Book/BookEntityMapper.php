<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Infrastructure\Persistence\Book;

use Doctrine\ORM\EntityManagerInterface;
use Library\Circulation\Common\Domain\Book\Book;
use Library\Circulation\Common\Infrastructure\Entity\BookEntity;
use Library\Circulation\Common\Infrastructure\Persistence\EntityMapperTrait;

/**
 * @package Library\Circulation\Common\Infrastructure\Persistence\Book
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
     * @param \Library\Circulation\Common\Infrastructure\Entity\BookEntity
     * @param \Library\Circulation\Common\Domain\Book\Book
     * @return \Library\Circulation\Common\Infrastructure\Entity\BookEntity
     */
    public function mapToExistingEntity(BookEntity $entity, Book $model): BookEntity
    {
        return $this->mapProperties($model, $entity, $this->entityManager);
    }

    /**
     * @param \Library\Circulation\Common\Domain\Book\Book
     * @return \Library\Circulation\Common\Infrastructure\Entity\BookEntity
     */
    public function mapToNewEntity(Book $model): BookEntity
    {
        return $this->mapToExistingEntity($this->createNewInstanceWithoutConstructor(BookEntity::class), $model);
    }
}
