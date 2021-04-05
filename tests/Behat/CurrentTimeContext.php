<?php

declare(strict_types=1);

namespace Library\Circulation\Tests\Behat;

use Library\Circulation\Common\Domain\ValueObject\Date;
use Library\Circulation\Common\Domain\ValueObject\DateTime;
use Library\Circulation\Common\Infrastructure\Date\DateTimeBuilder;

trait CurrentTimeContext
{
    public ?DateTime $now = null;

    abstract protected function todayIs(): Date;

    /**
     * @Given /^The time is (.*)$/
     * @param string $time
     */
    public function theTimeIs10(string $time): void
    {
        [$hour, $minutes] = explode(':', $time);
        $this->now = $this->todayIs()->toDateTime()->setTime((int)$hour, (int)$minutes, 0);
    }

    /**
     * @Given /^The today is date (.*)$/
     * @param string $dateTime
     */
    public function theTodayIsDate20200110(string $dateTime): void
    {
        $this->now = DateTimeBuilder::fromString($dateTime);
    }
}
