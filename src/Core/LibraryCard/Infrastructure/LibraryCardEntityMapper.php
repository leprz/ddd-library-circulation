<?php

declare(strict_types=1);

namespace Library\Circulation\Core\LibraryCard\Infrastructure;

use Doctrine\ORM\EntityManagerInterface;
use Library\Circulation\Common\Infrastructure\Persistence\EntityMapperTrait;
use Library\Circulation\Core\LibraryCard\Domain\LibraryCard;

/**
 * @package Library\Circulation\Core\LibraryCard\Infrastructure
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
     * @param \Library\Circulation\Core\LibraryCard\Infrastructure\LibraryCardEntity
     * @param \Library\Circulation\Core\LibraryCard\Domain\LibraryCard
     * @return \Library\Circulation\Core\LibraryCard\Infrastructure\LibraryCardEntity
     */
    public function mapToExistingEntity(LibraryCardEntity $entity, LibraryCard $model): LibraryCardEntity
    {
        return $this->mapProperties($model, $entity, $this->entityManager);
    }

    /**
     * @param \Library\Circulation\Core\LibraryCard\Domain\LibraryCard
     * @return \Library\Circulation\Core\LibraryCard\Infrastructure\LibraryCardEntity
     */
    public function mapToNewEntity(LibraryCard $model): LibraryCardEntity
    {
        return $this->mapToExistingEntity(
            $this->createNewInstanceWithoutConstructor(LibraryCardEntity::class),
            $model
        );
    }
}
