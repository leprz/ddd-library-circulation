<?php

declare(strict_types=1);

namespace Library\Circulation\Core\Patron\Infrastructure;

use Library\Circulation\Core\Patron\Domain\Patron;

/**
 * @package Library\Circulation\Core\Patron\Infrastructure
 */
class PatronProxy extends Patron
{
    /**
     * @param \Library\Circulation\Core\Patron\Infrastructure\PatronEntity
     */
    public function __construct(PatronEntity $entity)
    {
    }

    /**
     * @param \Library\Circulation\Core\Patron\Infrastructure\PatronEntityMapper
     * @return \Library\Circulation\Core\Patron\Infrastructure\PatronEntity
     */
    public function getEntity(PatronEntityMapper $mapper): PatronEntity
    {
    }
}
