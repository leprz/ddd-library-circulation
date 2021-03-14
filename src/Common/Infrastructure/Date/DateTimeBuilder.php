<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Infrastructure\Date;

use Library\Circulation\Common\Application\Date\Builder\DateTimeBuilderInterface;
use Library\Circulation\Common\Domain\ValueObject\DateTime;
use Library\Circulation\Common\Infrastructure\Date\Adapter\DateTimeAdapter;

class DateTimeBuilder implements DateTimeBuilderInterface
{
    public static function fromString(string $date): DateTime
    {
        return DateTimeAdapter::fromString($date);
    }
}
