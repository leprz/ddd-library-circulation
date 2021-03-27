<?php

declare(strict_types=1);

namespace Library\Circulation\Core\OtherMaterial\Infrastructure;

use Library\Circulation\Core\OtherMaterial\Domain\OtherMaterialConstructorParameterInterface;
use Library\Circulation\Core\OtherMaterial\Domain\OtherMaterialType;

/**
 * @package Library\Circulation\Core\OtherMaterial\Infrastructure
 */
class OtherMaterialEntity implements OtherMaterialConstructorParameterInterface
{
    public function isForInLibraryUseOnly(): bool
    {
        // TODO: Implement isForInLibraryUseOnly() method.
    }

    public function getName(): string
    {
        // TODO: Implement getName() method.
    }

    public function getType(): OtherMaterialType
    {
        // TODO: Implement getType() method.
    }
}
