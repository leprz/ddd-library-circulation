<?php

declare(strict_types=1);

namespace Library\Circulation\Core\Patron\Infrastructure;

use Doctrine\ORM\EntityManagerInterface;
use Library\Circulation\Core\Patron\Application\PatronRepositoryInterface;
use Library\Circulation\Core\Patron\Domain\Patron;
use Library\SharedKernel\Infrastructure\Persistence\QueryBuilderTrait;

/**
 * @package Library\Circulation\Core\Patron\Infrastructure
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
     * @return \Library\Circulation\Core\Patron\Domain\Patron
     */
    public function getById(): Patron
    {
    }
}
