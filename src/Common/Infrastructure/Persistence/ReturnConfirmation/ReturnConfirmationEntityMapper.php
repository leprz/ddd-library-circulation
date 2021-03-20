<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Infrastructure\Persistence\ReturnConfirmation;

use Doctrine\ORM\EntityManagerInterface;
use Library\Circulation\Common\Domain\ReturnConfirmation\ReturnConfirmation;
use Library\Circulation\Common\Infrastructure\Entity\ReturnConfirmationEntity;
use Library\Circulation\Common\Infrastructure\Persistence\EntityMapperTrait;

/**
 * @package Library\Circulation\Common\Infrastructure\Persistence\ReturnConfirmation
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
     * @param \Library\Circulation\Common\Infrastructure\Entity\ReturnConfirmationEntity
     * @param \Library\Circulation\Common\Domain\ReturnConfirmation\ReturnConfirmation
     * @return \Library\Circulation\Common\Infrastructure\Entity\ReturnConfirmationEntity
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
     * @param \Library\Circulation\Common\Domain\ReturnConfirmation\ReturnConfirmation
     * @return \Library\Circulation\Common\Infrastructure\Entity\ReturnConfirmationEntity
     */
    public function mapToNewEntity(ReturnConfirmation $model): ReturnConfirmationEntity
    {
        return $this->mapToExistingEntity(
            $this->createNewInstanceWithoutConstructor(ReturnConfirmationEntity::class),
            $model
        );
    }
}
