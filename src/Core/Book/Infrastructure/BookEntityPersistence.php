<?php

declare(strict_types=1);

namespace Library\Circulation\Core\Book\Infrastructure;

use Doctrine\ORM\EntityManagerInterface;
use Library\Circulation\Common\Domain\DomainEvent\DomainEventStore;
use Library\Circulation\Common\Infrastructure\Persistence\Exception\PersistenceException;
use Library\Circulation\Core\Book\Application\BookPersistenceInterface;
use Library\Circulation\Core\Book\Domain\Book;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * @package Library\Circulation\Core\Book\Infrastructure
 */
class BookEntityPersistence implements BookPersistenceInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private BookEntityMapper $mapper,
        private DomainEventStore $eventStore,
    ) {
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
            $entity = $model->getEntity($this->mapper);

            $this->entityManager->persist(
                $entity
            );

            $entity->addEvents($this->entityManager, $this->eventStore->filterByEmitter(Book::class));
        }

        throw PersistenceException::saveUsedInsteadOfAdd();
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
