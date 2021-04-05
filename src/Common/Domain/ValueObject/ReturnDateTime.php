<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\ValueObject;

class ReturnDateTime
{
    public function __construct(private DateTime $returnedAt)
    {
    }

    public function wasWithin(DueDate $dueDate): bool
    {
        return !$dueDate->isBefore($this->returnedAt);
    }

    public function getOverDueTimePeriod(DueDate $dueDate): TimePeriod
    {
        return new TimePeriod(
            $this->getOverDueDays($dueDate),
            $this->getOverDueHours($dueDate),
            $this->getOverDueMinutes($dueDate)
        );
    }

    private function getOverDueDays(DueDate $dueDate): int
    {
        return $dueDate->daysAfter($this->returnedAt->asDate());
    }

    private function getOverDueHours(DueDate $dueDate): int
    {
        return $dueDate->hoursAfter($this->returnedAt->subtractDays($this->getOverDueDays($dueDate)));
    }

    private function getOverDueMinutes(DueDate $dueDate): int
    {
        return $dueDate->minutesAfter(
            $this->returnedAt->subtractDays(
                $this->getOverDueDays($dueDate)
            )->subtractHours(
                $this->getOverDueHours($dueDate)
            )
        );
    }

    public function toDateTime(): DateTime
    {
        return $this->returnedAt;
    }
}
