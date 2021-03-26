<?php

declare(strict_types=1);

namespace Library\Circulation\Core\OtherMaterial\Infrastructure;

use Doctrine\ORM\EntityManagerInterface;
use Library\Circulation\Core\OtherMaterial\Application\OtherMaterialRepositoryInterface;
use Library\Circulation\Core\OtherMaterial\Domain\OtherMaterial;
use Library\SharedKernel\Infrastructure\Persistence\QueryBuilderTrait;

/**
 * @package Library\Circulation\Core\OtherMaterial\Infrastructure
 */
class OtherMaterialEntityRepository implements OtherMaterialRepositoryInterface
{
    use QueryBuilderTrait;

    /**
     * @return string
     */
    protected static function entityClass(): string
    {
    }

    /**
     * @return \Library\Circulation\Core\OtherMaterial\Domain\OtherMaterial
     */
    public function getById(): OtherMaterial
    {
    }

    /**
     * @param \Doctrine\ORM\EntityManagerInterface
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
    }

    /**
     * @return \Doctrine\ORM\EntityManagerInterface
     */
    protected function getEntityManager(): EntityManagerInterface
    {
    }
}
