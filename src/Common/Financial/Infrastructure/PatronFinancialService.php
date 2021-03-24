<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Financial\Infrastructure;

use Library\Circulation\Common\Domain\Patron\PatronId;
use Library\Circulation\Common\Financial\Application\PatronFinancialServiceInterface;

class PatronFinancialService implements PatronFinancialServiceInterface
{
    public function getBalanceFor(PatronId $patronId): float
    {
        return 0;
    }
}
