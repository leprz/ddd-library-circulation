<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\OtherMaterialCheckOut\Domain;

use Library\Circulation\Core\BusinessHours\Domain\BusinessHoursServiceInterface;
use Library\Circulation\Core\OtherMaterial\Domain\OtherMaterialType;
use Library\Circulation\Core\OtherMaterial\Domain\Privilege\OtherMaterialPrivilegeBuilder;

class OtherMaterialCheckOutPolicyBuilder
{
    public function __construct(
        private OtherMaterialPrivilegeBuilder $privilegeBuilder,
        private BusinessHoursServiceInterface $businessHoursService
    ) {
    }

    public function getPolicy(OtherMaterialType $materialType): OtherMaterialCheckOutPolicy
    {
        return new OtherMaterialCheckOutPolicy(
            $this->privilegeBuilder->forMaterialType($materialType),
            $this->businessHoursService,
        );
    }
}
