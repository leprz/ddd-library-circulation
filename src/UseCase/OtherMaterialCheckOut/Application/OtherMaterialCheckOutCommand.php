<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\OtherMaterialCheckOut\Application;

use Library\Circulation\Core\Patron\Domain\PatronId;
use Library\Circulation\Core\Patron\Domain\PatronIdentity;
use Library\Circulation\Core\Patron\Domain\PatronType;
use Library\Circulation\UseCase\OtherMaterialCheckOut\Domain\OtherMaterialCheckOutDataInterface;

/**
 * @package Library\Circulation\UseCase\OtherMaterialCheckOut\Application
 */
class OtherMaterialCheckOutCommand implements OtherMaterialCheckOutDataInterface
{
    public function __construct(private PatronIdentity $borrower)
    {
    }

    public function getBorrowerType(): PatronType
    {
        return $this->borrower->getType();
    }

    public function getBorrowerId(): PatronId
    {
        return $this->borrower->getPatronId();
    }
}
