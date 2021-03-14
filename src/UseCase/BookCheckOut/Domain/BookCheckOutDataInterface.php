<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\BookCheckOut\Domain;

use Library\Circulation\Common\Domain\Patron\PatronId;

interface BookCheckOutDataInterface extends LibraryCardLendDataInterface
{
    public function getBorrowerId(): PatronId;
}
