<?php
declare(strict_types=1);

namespace Library\Circulation\Common\Infrastructure\Date;

use Library\Circulation\Common\Application\Date\Builder\DateBuilderInterface;
use Library\Circulation\Common\Domain\ValueObject\Date;
use Library\Circulation\Common\Infrastructure\Date\Adapter\DateAdapter;

class DateBuilder implements DateBuilderInterface
{
    public static function fromString(string $date): Date
    {
        return DateAdapter::fromString($date);
    }
}
