<?php

declare(strict_types=1);

namespace Library\Circulation\Tests\Common\Infrastructure\Date\Adapter;

use Aeon\Calendar\Gregorian\DateTime;
use Library\Circulation\Common\Infrastructure\Date\Adapter\DateAdapter;
use Library\Circulation\Tests\IsolatedTestCase;

class DateAdapterTest extends IsolatedTestCase
{
    /**
     * @test
     * @small
     */
    public function diff_days_gives_correct_number_of_days_when_second_date_is_grater(): void
    {
        $date1 = new DateAdapter(DateTime::fromString('2020-01-01'));
        $date2 = new DateAdapter(DateTime::fromString('2020-01-06'));

        self::assertEquals(
            5,
            $date1->daysUntil($date2)
        );
    }

    /**
     * @test
     * @small
     */
    public function diff_days_gives_correct_number_of_days_when_second_date_is_smaller(): void
    {
        $date1 = new DateAdapter(DateTime::fromString('2020-01-06'));
        $date2 = new DateAdapter(DateTime::fromString('2020-01-01'));

        self::assertEquals(
            -5,
            $date1->daysUntil($date2)
        );
    }
}
