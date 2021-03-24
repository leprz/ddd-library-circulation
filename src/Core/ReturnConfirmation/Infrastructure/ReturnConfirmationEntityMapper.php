<?php

declare(strict_types=1);

namespace Library\Circulation\Core\ReturnConfirmation\Infrastructure;

use Doctrine\ORM\EntityManagerInterface;
use Library\Circulation\Common\Infrastructure\Persistence\EntityMapperTrait;
use Library\Circulation\Core\ReturnConfirmation\Domain\ReturnConfirmation;

/**
 * @package Library\Circulation\Core\ReturnConfirmation\Infrastructure
 */
class ReturnConfirmationEntityMapper
{
    use EntityMapperTrait;

    /**
     * @param \Doctrine\ORM\EntityManagerInterface
     */
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    /**
     * @param \Library\Circulation\Core\ReturnConfirmation\Infrastructure\ReturnConfirmationEntity
     * @param \Library\Circulation\Core\ReturnConfirmation\Domain\ReturnConfirmation
     * @return \Library\Circulation\Core\ReturnConfirmation\Infrastructure\ReturnConfirmationEntity
     */
    public function mapToExistingEntity(
        ReturnConfirmationEntity $entity,
        ReturnConfirmation $model
    ): ReturnConfirmationEntity {
        return $this->mapProperties(
            $model,
            $entity,
            $this->entityManager
        );
    }

    /**
     * @param \Library\Circulation\Core\ReturnConfirmation\Domain\ReturnConfirmation
     * @return \Library\Circulation\Core\ReturnConfirmation\Infrastructure\ReturnConfirmationEntity
     */
    public function mapToNewEntity(ReturnConfirmation $model): ReturnConfirmationEntity
    {
        return $this->mapToExistingEntity(
            $this->createNewInstanceWithoutConstructor(ReturnConfirmationEntity::class),
            $model
        );
    }
}
