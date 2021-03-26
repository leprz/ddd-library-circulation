<?php

declare(strict_types=1);

namespace Library\Circulation\Core\OtherMaterial\Domain;

/**
 * @package Library\Circulation\Core\OtherMaterial\Domain
 */
class OtherMaterialConstructorParameter implements OtherMaterialConstructorParameterInterface
{
    public function __construct(private bool $inLibraryUseOnly, private string $name, private OtherMaterialType $type)
    {
    }

    public function isForInLibraryUseOnly(): bool
    {
        return $this->inLibraryUseOnly;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): OtherMaterialType
    {
        return $this->type;
    }
}
