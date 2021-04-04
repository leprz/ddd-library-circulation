<?php

declare(strict_types=1);

namespace Library\Circulation\Core\LibraryCard\Infrastructure;

use Doctrine\ORM\EntityManagerInterface;
use Library\Circulation\Core\LibraryCard\Application\LibraryCardPersistenceInterface;
use Library\Circulation\Core\LibraryCard\Domain\LibraryCard;

/**
 * @package Library\Circulation\Core\LibraryCard\Infrastructure
 */
class LibraryCardEntityPersistence implements LibraryCardPersistenceInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private LibraryCardEntityMapper $mapper
    )  {
    }

    /**
     * @return void
     */
    public function flush(): void
    {
        $this->entityManager->flush();
    }

    /**
     * @param \Library\Circulation\Core\LibraryCard\Domain\LibraryCard
     * @return void
     */
    public function save(LibraryCard $model): void
    {
        if ($model instanceof LibraryCardProxy) {
            $this->entityManager->persist($model->getEntity($this->mapper));
        }
    }

    /**
     * @param \Library\Circulation\Core\LibraryCard\Domain\LibraryCard
     * @return void
     */
    public function add(LibraryCard $model): void
    {
        $this->entityManager->persist($this->mapper->mapToNewEntity($model));
    }
}
