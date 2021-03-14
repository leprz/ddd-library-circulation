<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Application\Date;

use Library\Circulation\Common\Application\Date\Builder\AdapterNotInitializedException;
use Library\Circulation\Common\Application\Date\Builder\DateTimeBuilderInterface;
use Library\Circulation\Common\Application\Exception\InvalidArgumentException;
use Library\Circulation\Common\Domain\ValueObject\DateTime;

class DateTimeFactory
{
    private static ?DateTimeBuilderInterface $adapter = null;

    public static function fromString(string $date): DateTime
    {
        self::assertHasNoDynamicDates($date);

        return self::adapter()::fromString($date);
    }

    private static function assertHasNoDynamicDates(string $date): void
    {
        if ($date === 'now') {
            throw new InvalidArgumentException(
                sprintf(
                    'Can not use dynamically created date. Please use %s instead of [%s]',
                    ClockInterface::class,
                    $date
                )
            );
        }
    }

    private static function adapter(): DateTimeBuilderInterface
    {
        if (self::$adapter === null) {
            throw AdapterNotInitializedException::fromClassName(self::class);
        }

        return self::$adapter;
    }

    protected static function setAdapter(DateTimeBuilderInterface $adapter): void
    {
        self::$adapter = $adapter;
    }
}
