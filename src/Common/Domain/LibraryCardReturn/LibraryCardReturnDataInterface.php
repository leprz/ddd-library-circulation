<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\LibraryCardReturn;

use Library\Circulation\Common\Domain\ValueObject\ReturnDateTime;
use Library\Circulation\Core\Patron\Domain\PatronId;

/**
 * @package Library\Circulation\Common\Domain\LibraryMaterialReturn
 */
interface LibraryCardReturnDataInterface
{
    public function getReturnedAt(): ReturnDateTime;

    public function getBorrowerId(): PatronId;
}
