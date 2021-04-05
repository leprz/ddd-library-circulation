<?php

declare(strict_types=1);

namespace Library\Circulation\Tests\Common\Domain\ValueObject;

use Library\Circulation\Common\Domain\ValueObject\DueDate;
use Library\Circulation\Common\Domain\ValueObject\ReturnDateTime;
use Library\Circulation\Common\Infrastructure\Date\DateTimeBuilder;
use Library\Circulation\Tests\IsolatedTestCase;

class ReturnDateTimeTest extends IsolatedTestCase
{
    /**
     * @test
     * @small
     */
    public function overdue_days_is_counted_correctly(): void
    {
        $dueDate = new DueDate(DateTimeBuilder::fromString('2020-01-01 10:00:00'));
        $returnDateTime = new ReturnDateTime(DateTimeBuilder::fromString('2020-01-03 12:15:00'));

        self::assertEquals(2, $returnDateTime->getOverDueDays($dueDate));
        self::assertEquals(2, $returnDateTime->getOverDueHours($dueDate));
        self::assertEquals(15, $returnDateTime->getOverDueMinutes($dueDate));
    }
}
