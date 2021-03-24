<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\BookCheckOut\Domain;

use Library\Circulation\Common\Domain\Patron\PatronId;
use Library\Circulation\Common\Domain\Patron\PatronType;

interface LibraryCardLendDataInterface
{
    public function getBorrowerType(): PatronType;
    public function getBorrowerId(): PatronId;
}
