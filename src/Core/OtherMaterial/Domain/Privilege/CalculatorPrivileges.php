<?php

declare(strict_types=1);

namespace Library\Circulation\Core\OtherMaterial\Domain\Privilege;

use Library\Circulation\Common\Domain\ValueObject\LoanPeriod;
use Library\Circulation\Core\OtherMaterial\Domain\OtherMaterialType;

class CalculatorPrivileges extends OtherMaterialPrivileges
{
    private const ITEMS_LIMIT = 1;
    private const OVERDUE_ITEMS_LIMIT = 1;

    protected static function type(): OtherMaterialType
    {
        return OtherMaterialType::calculator();
    }

    protected static function loanPeriod(): LoanPeriod
    {
        return LoanPeriod::halfHoursBeforeClosing(1);
    }

    public function getItemsLimit(): int
    {
        return self::ITEMS_LIMIT;
    }

    public function getOverdueItemsLimit(): int
    {
        return self::OVERDUE_ITEMS_LIMIT;
    }
}
