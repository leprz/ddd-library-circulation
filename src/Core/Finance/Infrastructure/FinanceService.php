<?php

declare(strict_types=1);

namespace Library\Circulation\Core\Finance\Infrastructure;

use Library\Circulation\Core\Finance\Application\FinanceServiceInterface;
use Library\Circulation\Core\Patron\Domain\PatronId;

class FinanceService implements FinanceServiceInterface
{
    public function getBalanceFor(PatronId $patronId): float
    {
        return 0;
    }
}
