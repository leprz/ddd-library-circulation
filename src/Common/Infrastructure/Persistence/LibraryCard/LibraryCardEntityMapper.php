<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Infrastructure\Persistence\LibraryCard;

use Doctrine\ORM\EntityManagerInterface;
use Library\Circulation\Common\Domain\LibraryCard\LibraryCard;
use Library\Circulation\Common\Infrastructure\Entity\LibraryCardEntity;
use Library\Circulation\Common\Infrastructure\Persistence\EntityMapperTrait;

/**
 * @package Library\Circulation\Common\Infrastructure\Persistence\LibraryCard
 */
class LibraryCardEntityMapper
{
    use EntityMapperTrait;

    /**
     * @param \Doctrine\ORM\EntityManagerInterface
     */
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    /**
     * @param \Library\Circulation\Common\Infrastructure\Entity\LibraryCardEntity
     * @param \Library\Circulation\Common\Domain\LibraryCard\LibraryCard
     * @return \Library\Circulation\Common\Infrastructure\Entity\LibraryCardEntity
     */
    public function mapToExistingEntity(LibraryCardEntity $entity, LibraryCard $model): LibraryCardEntity
    {
        return $this->mapProperties($model, $entity, $this->entityManager);
    }

    /**
     * @param \Library\Circulation\Common\Domain\LibraryCard\LibraryCard
     * @return \Library\Circulation\Common\Infrastructure\Entity\LibraryCardEntity
     */
    public function mapToNewEntity(LibraryCard $model): LibraryCardEntity
    {
        return $this->mapToExistingEntity(
            $this->createNewInstanceWithoutConstructor(LibraryCardEntity::class),
            $model
        );
    }
}
