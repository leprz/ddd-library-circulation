<?php

declare(strict_types=1);

namespace Library\Circulation\Core\LibraryCard\Domain;

use Library\Circulation\Core\Patron\Domain\PatronId;

interface LibraryCardLendActionInterface
{
    public function getAccountBalance(PatronId $patronId): float;
}
