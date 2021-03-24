<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Financial\Application;

use Library\Circulation\Common\Domain\Patron\PatronId;

interface PatronFinancialServiceInterface
{
    public function getBalanceFor(PatronId $patronId): float;
}
