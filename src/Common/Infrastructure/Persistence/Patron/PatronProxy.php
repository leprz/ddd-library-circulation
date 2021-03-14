<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Infrastructure\Persistence\Patron;

use Library\Circulation\Common\Domain\Patron\Patron;
use Library\Circulation\Common\Infrastructure\Entity\PatronEntity;

/**
 * @package Library\Circulation\Common\Infrastructure\Persistence\Patron
 */
class PatronProxy extends Patron
{
    /**
     * @param \Library\Circulation\Common\Infrastructure\Entity\PatronEntity
     */
    public function __construct(PatronEntity $entity)
    {
    }

    /**
     * @param \Library\Circulation\Common\Infrastructure\Persistence\Patron\PatronEntityMapper
     * @return \Library\Circulation\Common\Infrastructure\Entity\PatronEntity
     */
    public function getEntity(PatronEntityMapper $mapper): PatronEntity
    {
    }
}
