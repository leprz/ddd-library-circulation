<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Infrastructure\Persistence\ReturnConfirmation;

use Library\Circulation\Common\Domain\ReturnConfirmation\ReturnConfirmation;
use Library\Circulation\Common\Infrastructure\Entity\ReturnConfirmationEntity;

/**
 * @package Library\Circulation\Common\Infrastructure\Persistence\ReturnConfirmation
 */
class ReturnConfirmationProxy extends ReturnConfirmation
{
    /**
     * @param \Library\Circulation\Common\Infrastructure\Entity\ReturnConfirmationEntity
     */
    public function __construct(private ReturnConfirmationEntity $entity)
    {
        parent::__construct($entity);
    }

    /**
     * @param \Library\Circulation\Common\Infrastructure\Persistence\ReturnConfirmation\ReturnConfirmationEntityMapper
     * @return \Library\Circulation\Common\Infrastructure\Entity\ReturnConfirmationEntity
     */
    public function getEntity(ReturnConfirmationEntityMapper $mapper): ReturnConfirmationEntity
    {
        return $mapper->mapToExistingEntity($this->entity, $this);
    }
}
