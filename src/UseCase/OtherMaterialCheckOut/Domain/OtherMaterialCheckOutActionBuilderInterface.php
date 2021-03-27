<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\OtherMaterialCheckOut\Domain;

use Library\Circulation\Core\OtherMaterial\Domain\OtherMaterialType;

interface OtherMaterialCheckOutActionBuilderInterface
{
    public function getAction(OtherMaterialType $materialType): OtherMaterialCheckOutActionInterface;
}
