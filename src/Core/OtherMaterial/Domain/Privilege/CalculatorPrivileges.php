<?php

declare(strict_types=1);

namespace Library\Circulation\Core\OtherMaterial\Domain\Privilege;

use Library\Circulation\Common\Domain\ValueObject\LoanPeriod;
use Library\Circulation\Core\OtherMaterial\Domain\OtherMaterialType;

class CalculatorPrivileges extends OtherMaterialPrivileges
{
    protected static function type(): OtherMaterialType
    {
        return OtherMaterialType::calculator();
    }

    protected static function loanPeriod(): LoanPeriod
    {
        return LoanPeriod::halfHoursBeforeClosing(1);
    }
}
