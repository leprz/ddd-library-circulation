<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Infrastructure\Persistence\Patron;

use Doctrine\ORM\EntityManagerInterface;
use Library\Circulation\Common\Domain\Patron\Patron;
use Library\Circulation\Common\Infrastructure\Entity\PatronEntity;
use Library\Circulation\Common\Infrastructure\Persistence\EntityMapperTrait;

/**
 * @package Library\Circulation\Common\Infrastructure\Persistence\Patron
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
     * @param \Library\Circulation\Common\Infrastructure\Entity\PatronEntity
     * @param \Library\Circulation\Common\Domain\Patron\Patron
     * @return \Library\Circulation\Common\Infrastructure\Entity\PatronEntity
     */
    public function mapToExistingEntity(PatronEntity $entity, Patron $model): PatronEntity
    {
    }

    /**
     * @param \Library\Circulation\Common\Domain\Patron\Patron
     * @return \Library\Circulation\Common\Infrastructure\Entity\PatronEntity
     */
    public function mapToNewEntity(Patron $cart): PatronEntity
    {
    }
}
