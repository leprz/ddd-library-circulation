<?php

declare(strict_types=1);

namespace Library\Circulation\Core\OtherMaterial\Domain;

/**
 * @package Library\Circulation\Core\OtherMaterial\Domain
 */
interface OtherMaterialConstructorParameterInterface
{
    public function isForInLibraryUseOnly(): bool;

    public function getName(): string;

    public function getType(): OtherMaterialType;
}
