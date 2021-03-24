<?php

declare(strict_types=1);

namespace Library\Circulation\Core\LibraryCard\Infrastructure;

use Library\Circulation\Core\LibraryCard\Domain\LibraryCard;

/**
 * @package Library\Circulation\Core\LibraryCard\Infrastructure
 */
class LibraryCardProxy extends LibraryCard
{
    /**
     * @param \Library\Circulation\Core\LibraryCard\Infrastructure\LibraryCardEntity
     */
    public function __construct(private LibraryCardEntity $entity)
    {
        parent::__construct($entity);
    }

    /**
     * @param \Library\Circulation\Core\LibraryCard\Infrastructure\LibraryCardEntityMapper
     * @return \Library\Circulation\Core\LibraryCard\Infrastructure\LibraryCardEntity
     */
    public function getEntity(LibraryCardEntityMapper $mapper): LibraryCardEntity
    {
        return $mapper->mapToExistingEntity($this->entity, $this);
    }
}
