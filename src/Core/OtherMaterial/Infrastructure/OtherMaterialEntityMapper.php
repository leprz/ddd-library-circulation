<?php

declare(strict_types=1);

namespace Library\Circulation\Core\OtherMaterial\Infrastructure;

use Doctrine\ORM\EntityManagerInterface;
use Library\Circulation\Common\Infrastructure\Persistence\EntityMapperTrait;
use Library\Circulation\Core\OtherMaterial\Domain\OtherMaterial;

/**
 * @package Library\Circulation\Core\OtherMaterial\Infrastructure
 */
class OtherMaterialEntityMapper
{
    use EntityMapperTrait;

    /**
     * @param \Doctrine\ORM\EntityManagerInterface
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
    }

    /**
     * @param \Library\Circulation\Core\OtherMaterial\Infrastructure\OtherMaterialEntity
     * @param \Library\Circulation\Core\OtherMaterial\Domain\OtherMaterial
     * @return \Library\Circulation\Core\OtherMaterial\Infrastructure\OtherMaterialEntity
     */
    public function mapToExistingEntity(OtherMaterialEntity $entity, OtherMaterial $model): OtherMaterialEntity
    {
    }

    /**
     * @param \Library\Circulation\Core\OtherMaterial\Domain\OtherMaterial
     * @return \Library\Circulation\Core\OtherMaterial\Infrastructure\OtherMaterialEntity
     */
    public function mapToNewEntity(OtherMaterial $cart): OtherMaterialEntity
    {
    }
}
