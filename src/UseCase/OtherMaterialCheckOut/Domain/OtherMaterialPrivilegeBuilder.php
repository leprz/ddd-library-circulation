<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\OtherMaterialCheckOut\Domain;

use Library\Circulation\Core\OtherMaterial\Domain\OtherMaterialType;
use Library\Circulation\Core\OtherMaterial\Domain\Privilege\CalculatorPrivileges;
use Library\Circulation\Core\OtherMaterial\Domain\Privilege\GamePrivileges;
use Library\Circulation\Core\OtherMaterial\Domain\Privilege\OtherMaterialPrivileges;

class OtherMaterialPrivilegeBuilder
{
    /** @var \Library\Circulation\Core\OtherMaterial\Domain\Privilege\OtherMaterialPrivileges[] */
    private array $privileges;

    public function __construct()
    {
        $this->privileges[] = new CalculatorPrivileges();
        $this->privileges[] = new GamePrivileges();
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
