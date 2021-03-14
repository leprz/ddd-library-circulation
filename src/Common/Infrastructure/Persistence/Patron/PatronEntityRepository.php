<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Infrastructure\Persistence\Patron;

use Doctrine\ORM\EntityManagerInterface;
use Library\Circulation\Common\Application\Persistence\PatronRepositoryInterface;
use Library\Circulation\Common\Domain\Patron\Patron;
use Library\Circulation\Common\Infrastructure\Entity\PatronEntity;
use Library\SharedKernel\Infrastructure\Persistence\QueryBuilderTrait;

/**
 * @package Library\Circulation\Common\Infrastructure\Persistence\Patron
 */
class PatronEntityRepository implements PatronRepositoryInterface
{
    use QueryBuilderTrait;

    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    /**
     * @return string
     */
    protected static function entityClass(): string
    {
        return PatronEntity::class;
    }

    protected function getEntityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }

    /**
     * @return \Library\Circulation\Common\Domain\Patron\Patron
     */
    public function getById(): Patron
    {
    }
}
