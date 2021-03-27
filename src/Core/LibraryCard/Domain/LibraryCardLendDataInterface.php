<?php

declare(strict_types=1);

namespace Library\Circulation\Core\LibraryCard\Domain;

use Library\Circulation\Core\Patron\Domain\PatronId;
use Library\Circulation\Core\Patron\Domain\PatronType;

interface LibraryCardLendDataInterface
{
    public function getBorrowerType(): PatronType;
    public function getBorrowerId(): PatronId;
}
