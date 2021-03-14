<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Application\Date;

use Library\Circulation\Common\Application\Date\Builder\AdapterNotInitializedException;
use Library\Circulation\Common\Application\Date\Builder\DateBuilderInterface;
use Library\Circulation\Common\Application\Exception\InvalidArgumentException;
use Library\Circulation\Common\Domain\ValueObject\Date;

class DateFactory
{
    private static ?DateBuilderInterface $adapter = null;

    public static function fromString(string $date): Date
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

    private static function adapter(): DateBuilderInterface
    {
        if (self::$adapter === null) {
            throw AdapterNotInitializedException::fromClassName(self::class);
        }

        return self::$adapter;
    }

    protected static function setAdapter(DateBuilderInterface $adapter): void
    {
        self::$adapter = $adapter;
    }
}
