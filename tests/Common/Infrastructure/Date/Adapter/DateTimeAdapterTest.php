<?php

declare(strict_types=1);

namespace Library\Circulation\Tests\Common\Infrastructure\Date\Adapter;

use Aeon\Calendar\Gregorian\DateTime;
use Library\Circulation\Common\Infrastructure\Date\Adapter\DateTimeAdapter;
use Library\Circulation\Tests\IsolatedTestCase;

class DateTimeAdapterTest extends IsolatedTestCase
{
    /**
     * @test
     * @small
     */
    public function diff_hours_calculate_correct_value_when_first_date_is_grater(): void
    {
        $dateTime1 = new DateTimeAdapter(DateTime::fromString('2020-01-01 10:00:00'));
        $dateTime2 = new DateTimeAdapter(DateTime::fromString('2020-01-01 15:00:00'));

        self::assertEquals(
            5,
            $dateTime1->hoursUntil($dateTime2)
        );
    }

    /**
     * @test
     * @small
     */
    public function diff_hours_calculate_correct_value_when_first_date_is_smaller(): void
    {
        $dateTime1 = new DateTimeAdapter(DateTime::fromString('2020-01-01 15:00:00'));
        $dateTime2 = new DateTimeAdapter(DateTime::fromString('2020-01-01 10:00:00'));

        self::assertEquals(
            -5,
            $dateTime1->hoursUntil($dateTime2)
        );
    }
}
