<?php

declare(strict_types=1);

namespace Library\Circulation\Core\Book\Infrastructure;

use Doctrine\ORM\EntityManagerInterface;
use Library\Circulation\Core\Book\Application\BookPersistenceInterface;
use Library\Circulation\Core\Book\Domain\Book;

/**
 * @package Library\Circulation\Core\Book\Infrastructure
 */
class BookEntityPersistence implements BookPersistenceInterface
{
    public function __construct(private EntityManagerInterface $entityManager, private BookEntityMapper $mapper)
    {
    }

    /**
     * @return void
     */
    public function flush(): void
    {
        $this->entityManager->flush();
    }

    /**
     * @param \Library\Circulation\Core\Book\Domain\Book
     * @return void
     */
    public function save(Book $model): void
    {
        if ($model instanceof BookProxy) {
            $this->entityManager->persist(
                $model->getEntity($this->mapper)
            );
        }
        // TODO Throw exception you should use Add method
    }

    /**
     * @param \Library\Circulation\Core\Book\Domain\Book
     * @return void
     */
    public function add(Book $model): void
    {
        $this->entityManager->persist(
            $this->mapper->mapToNewEntity($model)
        );
    }
}
