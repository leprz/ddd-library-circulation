<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Infrastructure\Persistence\LibraryCard;

use Library\Circulation\Common\Domain\LibraryCard\LibraryCard;
use Library\Circulation\Common\Infrastructure\Entity\LibraryCardEntity;

/**
 * @package Library\Circulation\Common\Infrastructure\Persistence\LibraryCard
 */
class LibraryCardProxy extends LibraryCard
{
    /**
     * @param \Library\Circulation\Common\Infrastructure\Entity\LibraryCardEntity
     */
    public function __construct(private LibraryCardEntity $entity)
    {
        parent::__construct($entity);
    }

    /**
     * @param \Library\Circulation\Common\Infrastructure\Persistence\LibraryCard\LibraryCardEntityMapper
     * @return \Library\Circulation\Common\Infrastructure\Entity\LibraryCardEntity
     */
    public function getEntity(LibraryCardEntityMapper $mapper): LibraryCardEntity
    {
        return $mapper->mapToExistingEntity($this->entity, $this);
    }
}
