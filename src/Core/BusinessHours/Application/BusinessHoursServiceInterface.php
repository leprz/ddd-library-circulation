<?php

declare(strict_types=1);

namespace Library\Circulation\Core\BusinessHours\Application;

use Library\Circulation\Common\Domain\ValueObject\Date;
use Library\Circulation\Common\Domain\ValueObject\DateTime;

interface BusinessHoursServiceInterface
{
    public function getEndOfBusinessFor(Date $day): DateTime;
}
