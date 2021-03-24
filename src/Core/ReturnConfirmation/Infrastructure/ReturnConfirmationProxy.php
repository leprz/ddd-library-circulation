<?php

declare(strict_types=1);

namespace Library\Circulation\Core\ReturnConfirmation\Infrastructure;

use Library\Circulation\Core\ReturnConfirmation\Domain\ReturnConfirmation;

/**
 * @package Library\Circulation\Core\ReturnConfirmation\Infrastructure
 */
class ReturnConfirmationProxy extends ReturnConfirmation
{
    /**
     * @param \Library\Circulation\Core\ReturnConfirmation\Infrastructure\ReturnConfirmationEntity
     */
    public function __construct(private ReturnConfirmationEntity $entity)
    {
        parent::__construct($entity);
    }

    /**
     * @param \Library\Circulation\Core\ReturnConfirmation\Infrastructure\ReturnConfirmationEntityMapper
     * @return \Library\Circulation\Core\ReturnConfirmation\Infrastructure\ReturnConfirmationEntity
     */
    public function getEntity(ReturnConfirmationEntityMapper $mapper): ReturnConfirmationEntity
    {
        return $mapper->mapToExistingEntity($this->entity, $this);
    }
}
