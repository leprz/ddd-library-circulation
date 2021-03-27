<?php

declare(strict_types=1);

namespace Library\Circulation\Core\BusinessHours\Infrastructure;

use Library\Circulation\Common\Domain\ValueObject\Date;
use Library\Circulation\Common\Domain\ValueObject\DateTime;
use Library\Circulation\Core\BusinessHours\Domain\BusinessHoursServiceInterface;

class BusinessHoursService implements BusinessHoursServiceInterface
{
    public function getEndOfBusinessFor(Date $day): DateTime
    {
        return $day->toDateTime()->setTime(17, 00, 00);
    }
}
