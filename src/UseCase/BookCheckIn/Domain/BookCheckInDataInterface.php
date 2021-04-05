<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\BookCheckIn\Domain;

use Library\Circulation\Common\Domain\LibraryCardReturn\LibraryCardReturnDataInterface;

/**
 * @package Library\Circulation\UseCase\BookCheckIn\Domain
 */
interface BookCheckInDataInterface extends LibraryCardReturnDataInterface
{
    public function getLibraryMaterialId();
}
