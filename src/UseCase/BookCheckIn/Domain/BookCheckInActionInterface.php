<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\BookCheckIn\Domain;

use Library\Circulation\Common\Domain\LibraryCardReturn\LibraryCardReturnActionInterface;

/**
 * @package Library\Circulation\UseCase\BookCheckIn\Domain
 */
interface BookCheckInActionInterface extends LibraryCardReturnActionInterface
{
    public function subscribeEvent(string $class, callable $callable);
}
