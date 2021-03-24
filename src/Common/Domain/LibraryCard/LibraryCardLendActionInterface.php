<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\LibraryCard;

use Library\Circulation\Common\Domain\Patron\PatronId;

interface LibraryCardLendActionInterface
{
    public function getAccountBalance(PatronId $patronId): float;
}
