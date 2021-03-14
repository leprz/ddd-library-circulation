<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Infrastructure\Persistence\LibraryCard;

use Doctrine\ORM\EntityManagerInterface;
use Library\Circulation\Common\Application\Persistence\LibraryCardPersistenceInterface;
use Library\Circulation\Common\Domain\LibraryCard\LibraryCard;

/**
 * @package Library\Circulation\Common\Infrastructure\Persistence\LibraryCard
 */
class LibraryCardEntityPersistence implements LibraryCardPersistenceInterface
{
    public function __construct(private EntityManagerInterface $entityManager, private LibraryCardEntityMapper $mapper)
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
     * @param \Library\Circulation\Common\Domain\LibraryCard\LibraryCard
     * @return void
     */
    public function save(LibraryCard $model): void
    {
        if ($model instanceof LibraryCardProxy) {
            $this->entityManager->persist($model->getEntity($this->mapper));
        }
    }

    /**
     * @param \Library\Circulation\Common\Domain\LibraryCard\LibraryCard
     * @return void
     */
    public function add(LibraryCard $model): void
    {
    }
}
