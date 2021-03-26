<?php

declare(strict_types=1);

namespace Library\Circulation\Core\OtherMaterial\Infrastructure;

use Library\Circulation\Core\OtherMaterial\Domain\OtherMaterial;

/**
 * @package Library\Circulation\Core\OtherMaterial\Infrastructure
 */
class OtherMaterialProxy extends OtherMaterial
{
    /**
     * @param \Library\Circulation\Core\OtherMaterial\Infrastructure\OtherMaterialEntity
     */
    public function __construct(OtherMaterialEntity $entity)
    {
    }

    /**
     * @param \Library\Circulation\Core\OtherMaterial\Infrastructure\OtherMaterialEntityMapper
     * @return \Library\Circulation\Core\OtherMaterial\Infrastructure\OtherMaterialEntity
     */
    public function getEntity(OtherMaterialEntityMapper $mapper): OtherMaterialEntity
    {
    }
}
