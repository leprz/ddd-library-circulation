<?php

declare(strict_types=1);

namespace Library\Circulation\Core\OtherMaterial\Domain\Privilege;

use Library\Circulation\Core\OtherMaterial\Domain\OtherMaterialType;

class OtherMaterialPrivilegeBuilder
{
    /** @var \Library\Circulation\Core\OtherMaterial\Domain\Privilege\OtherMaterialPrivileges[] */
    private array $privileges;

    public function __construct()
    {
        $this->privileges[] = new CalculatorPrivileges();
        $this->privileges[] = new GamePrivileges();
        $this->privileges[] = new MacVgaAdapterPrivileges();
    }

    public function forMaterialType(OtherMaterialType $type): OtherMaterialPrivileges
    {
        foreach ($this->privileges as $privilege) {
            if ($privilege->isAppliedForType($type)) {
                return $privilege;
            }
        }

        throw new \LogicException(
            sprintf('No privilege found for other material type [%s]', (string)$type)
        );
    }
}
