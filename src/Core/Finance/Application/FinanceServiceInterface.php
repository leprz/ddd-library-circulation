<?php

declare(strict_types=1);

namespace Library\Circulation\Core\Finance\Application;

use Library\Circulation\Core\Patron\Domain\PatronId;

interface FinanceServiceInterface
{
    public function getBalanceFor(PatronId $patronId): float;
}
