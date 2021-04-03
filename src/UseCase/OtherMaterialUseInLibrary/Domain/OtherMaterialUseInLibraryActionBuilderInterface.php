<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\OtherMaterialUseInLibrary\Domain;

use Library\Circulation\Core\OtherMaterial\Domain\OtherMaterialType;

interface OtherMaterialUseInLibraryActionBuilderInterface
{
    public function getAction(OtherMaterialType $materialType): OtherMaterialUseInLibraryActionInterface;
}
