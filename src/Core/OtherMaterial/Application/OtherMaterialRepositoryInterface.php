<?php

declare(strict_types=1);

namespace Library\Circulation\Core\OtherMaterial\Application;

use Library\Circulation\Core\LibraryMaterial\Domain\LibraryMaterialId;
use Library\Circulation\Core\OtherMaterial\Domain\OtherMaterial;

/**
 * @package Library\Circulation\Core\OtherMaterial\Application
 */
interface OtherMaterialRepositoryInterface
{
    /**
     * @param \Library\Circulation\Core\LibraryMaterial\Domain\LibraryMaterialId $materialId
     * @return \Library\Circulation\Core\OtherMaterial\Domain\OtherMaterial
     */
    public function getById(LibraryMaterialId $materialId): OtherMaterial;
}
