<?php

declare(strict_types=1);

namespace Library\Circulation\Tests\Common\TestData;

use Library\Circulation\Core\OtherMaterial\Domain\OtherMaterial;
use Library\Circulation\Core\OtherMaterial\Domain\OtherMaterialConstructorParameter;
use Library\Circulation\Core\OtherMaterial\Domain\OtherMaterialType;

class OtherMaterialMother extends OtherMaterial
{
    public static function calculator(): OtherMaterial
    {
        return new self(
            new OtherMaterialConstructorParameter(
                true,
                'Casio FX-991CEX',
                OtherMaterialType::calculator()
            ),
            LibraryCardMother::notBorrowed()
        );
    }
}
