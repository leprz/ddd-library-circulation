<?php

declare(strict_types=1);

namespace Library\Circulation\Core\OtherMaterial\Application;

use Library\Circulation\Core\OtherMaterial\Domain\OtherMaterial;

/**
 * @package Library\Circulation\Core\OtherMaterial\Application
 */
interface OtherMaterialPersistenceInterface
{
    /**
     * @return void
     */
    public function flush(): void;

    /**
     * @param \Library\Circulation\Core\OtherMaterial\Domain\OtherMaterial
     * @return void
     */
    public function save(OtherMaterial $model): void;

    /**
     * @param \Library\Circulation\Core\OtherMaterial\Domain\OtherMaterial
     * @return void
     */
    public function add(OtherMaterial $model): void;
}
