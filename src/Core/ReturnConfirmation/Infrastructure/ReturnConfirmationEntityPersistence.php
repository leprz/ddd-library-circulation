<?php

declare(strict_types=1);

namespace Library\Circulation\Core\ReturnConfirmation\Infrastructure;

use Doctrine\ORM\EntityManagerInterface;
use Library\Circulation\Core\ReturnConfirmation\Application\ReturnConfirmationPersistenceInterface;
use Library\Circulation\Core\ReturnConfirmation\Domain\ReturnConfirmation;
use Library\Circulation\Core\ReturnConfirmation\Domain\ReturnConfirmationId;

/**
 * @package Library\Circulation\Core\ReturnConfirmation\Infrastructure
 */
class ReturnConfirmationEntityPersistence implements ReturnConfirmationPersistenceInterface
{
    public function __construct(
        private ReturnConfirmationIdGenerator $idGenerator,
        private EntityManagerInterface $entityManager,
        private ReturnConfirmationEntityMapper $mapper
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
     * @param \Library\Circulation\Core\ReturnConfirmation\Domain\ReturnConfirmation
     * @return void
     */
    public function save(ReturnConfirmation $model): void
    {
    }

    /**
     * @param \Library\Circulation\Core\ReturnConfirmation\Domain\ReturnConfirmation
     * @return void
     */
    public function add(ReturnConfirmation $model): void
    {
        $entity = $this->mapper->mapToNewEntity($model);

        $this->entityManager->persist($entity);
    }

    public function generateNextId(): ReturnConfirmationId
    {
        return $this->idGenerator->generate();
    }
}
