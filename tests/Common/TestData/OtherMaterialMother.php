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

    public static function game(): OtherMaterial
    {
        return new self(
            new OtherMaterialConstructorParameter(
                false,
                'Heroes 3 of might and magic',
                OtherMaterialType::game()
            ),
            LibraryCardMother::notBorrowed()
        );
    }

    public static function macVgaAdapter(): OtherMaterialMother
    {
        return new self(
            new OtherMaterialConstructorParameter(
                true,
                'Mac VGA adapter',
                OtherMaterialType::macVgaAdapter()
            ),
            LibraryCardMother::notBorrowed()
        );
    }
}
