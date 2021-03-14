<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Infrastructure\Date;

use Library\Circulation\Common\Application\Date\ClockInterface;
use Library\Circulation\Common\Domain\ValueObject\Date;
use Library\Circulation\Common\Domain\ValueObject\DateTime;
use Library\Circulation\Common\Infrastructure\Date\Adapter\DateAdapter;
use Library\Circulation\Common\Infrastructure\Date\Adapter\DateTimeAdapter;

class SystemClock implements ClockInterface
{
    public function now(): DateTime
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        return new DateTimeAdapter(\Aeon\Calendar\Gregorian\DateTime::fromString('now'));
    }

    public function today(): Date
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        return new DateAdapter(\Aeon\Calendar\Gregorian\DateTime::fromString('now'));
    }
}
