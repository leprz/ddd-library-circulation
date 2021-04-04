<?php

declare(strict_types=1);

namespace Library\Circulation\Tests\Common\TestData;

use Library\Circulation\Core\Patron\Domain\PatronId;
use Library\Circulation\Core\ReturnConfirmation\Domain\ReturnConfirmation;

class ReturnConfirmationMother extends ReturnConfirmation
{
    public static function readBorrowerId(ReturnConfirmation $returnConfirmation): PatronId
    {
        return $returnConfirmation->getBorrowerId();
    }
}
