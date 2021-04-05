<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\ValueObject;

use Library\Circulation\Common\Domain\Exception\InvalidArgumentException;

class TimePeriod
{
    private int $days;
    private int $hours;
    private int $minutes;

    public function __construct(int $days, int $hours, int $minutes)
    {
        $this->setDays($days);
        $this->setHours($hours);
        $this->setMinutes($minutes);
    }

    private function setDays(int $days): void
    {
        $this->days = $days;
    }

    private function setHours(int $hours): void
    {
        self::assertHoursValueIsValid($hours);
        $this->hours = $hours;
    }

    private function setMinutes(int $minutes): void
    {
        self::assertMinutesValueIsValid($minutes);
        $this->minutes = $minutes;
    }

    private static function assertHoursValueIsValid(int $hours): void
    {
        if ($hours >= 24) {
            throw new InvalidArgumentException('Hours value should not be greater than 23');
        }
    }

    private static function assertMinutesValueIsValid(int $minutes): void
    {
        if ($minutes >= 60) {
            throw new InvalidArgumentException('Minutes value should not be greater than 59');
        }
    }

    public function __toString(): string
    {
        return "$this->days:$this->hours:$this->minutes";
    }

    public function isNotEmpty(): bool
    {
        return $this->days + $this->hours + $this->minutes !== 0;
    }
}
