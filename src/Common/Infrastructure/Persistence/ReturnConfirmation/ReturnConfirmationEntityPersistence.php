<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Infrastructure\Persistence\ReturnConfirmation;

use Doctrine\ORM\EntityManagerInterface;
use Library\Circulation\Common\Application\Persistence\ReturnConfirmation\ReturnConfirmationPersistenceInterface;
use Library\Circulation\Common\Domain\ReturnConfirmation\ReturnConfirmation;
use Library\Circulation\Common\Domain\ReturnConfirmation\ReturnConfirmationId;

/**
 * @package Library\Circulation\Common\Infrastructure\Persistence\ReturnConfirmation
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
     * @param \Library\Circulation\Common\Domain\ReturnConfirmation\ReturnConfirmation
     * @return void
     */
    public function save(ReturnConfirmation $model): void
    {
    }

    /**
     * @param \Library\Circulation\Common\Domain\ReturnConfirmation\ReturnConfirmation
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
