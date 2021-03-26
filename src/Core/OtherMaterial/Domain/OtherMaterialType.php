<?php

declare(strict_types=1);

namespace Library\Circulation\Core\OtherMaterial\Domain;

class OtherMaterialType
{
    private const CALCULATOR = 'calculator';

    private function __construct(private string $type)
    {
    }

    public static function calculator(): self
    {
        return new self(self::CALCULATOR);
    }

    public function equals(OtherMaterialType $calculator): bool
    {
        return $this->type === $calculator->type;
    }

    public function __toString(): string
    {
        return $this->type;
    }
}
