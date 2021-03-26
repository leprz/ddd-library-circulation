<?php

declare(strict_types=1);

namespace Library\Circulation\Core\OtherMaterial\Domain\Privilege;

use Library\Circulation\Common\Domain\ValueObject\LoanPeriod;
use Library\Circulation\Core\OtherMaterial\Domain\OtherMaterialType;

abstract class OtherMaterialPrivileges
{
    abstract protected static function type(): OtherMaterialType;

    abstract protected static function loanPeriod(): LoanPeriod;

    public function isAppliedForType(OtherMaterialType $type): bool
    {
        return $type->equals(static::type());
    }

    public function getLoanPeriod(): LoanPeriod
    {
        return static::loanPeriod();
    }
}
