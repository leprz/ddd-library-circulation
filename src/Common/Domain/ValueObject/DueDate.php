<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\ValueObject;

class DueDate
{
    public function __construct(private DateTime $dueDate)
    {
    }

    public function toDateTime(): DateTime
    {
        return $this->dueDate;
    }

    public function isBefore(DateTime $dateTime): bool
    {
        return $this->dueDate->isBefore($dateTime);
    }

    public function daysAfter(Date $date): int
    {
        $daysUntilDueDate = $date->daysUntil($this->dueDate->asDate());
        return $daysUntilDueDate < 0 ? abs($daysUntilDueDate) : 0;
    }

    public function hoursAfter(DateTime $dateTime): int
    {
        $hoursUntilDueDate = $dateTime->hoursUntil($this->dueDate);
        return $hoursUntilDueDate < 0 ? abs($hoursUntilDueDate) : 0;
    }

    public function minutesAfter(DateTime $dateTime): int
    {
        $minutesUntilDueDate = $dateTime->minutesUntil($this->dueDate);
        return $minutesUntilDueDate < 0 ? abs($minutesUntilDueDate) : 0;
    }
}
