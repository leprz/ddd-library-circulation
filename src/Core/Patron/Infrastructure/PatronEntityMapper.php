<?php

declare(strict_types=1);

namespace Library\Circulation\Core\Patron\Infrastructure;

use Doctrine\ORM\EntityManagerInterface;
use Library\Circulation\Common\Infrastructure\Persistence\EntityMapperTrait;
use Library\Circulation\Core\Patron\Domain\Patron;

/**
 * @package Library\Circulation\Core\Patron\Infrastructure
 */
class PatronEntityMapper
{
    use EntityMapperTrait;

    /**
     * @param \Doctrine\ORM\EntityManagerInterface
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
    }

    /**
     * @param \Library\Circulation\Core\Patron\Infrastructure\PatronEntity
     * @param \Library\Circulation\Core\Patron\Domain\Patron
     * @return \Library\Circulation\Core\Patron\Infrastructure\PatronEntity
     */
    public function mapToExistingEntity(PatronEntity $entity, Patron $model): PatronEntity
    {
    }

    /**
     * @param \Library\Circulation\Core\Patron\Domain\Patron
     * @return \Library\Circulation\Core\Patron\Infrastructure\PatronEntity
     */
    public function mapToNewEntity(Patron $cart): PatronEntity
    {
    }
}
