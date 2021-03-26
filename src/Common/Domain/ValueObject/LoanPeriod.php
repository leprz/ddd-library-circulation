<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\ValueObject;

class LoanPeriod
{
    private int $minutes;
    private int $days;
    private bool $isBeforeEndOfBusiness;

    public function __construct(int $minutes, int $days, bool $isBeforeEndOfBusiness)
    {
        $this->minutes = $minutes;
        $this->days = $days;
        $this->isBeforeEndOfBusiness = $isBeforeEndOfBusiness;
    }

    public static function halfHoursBeforeClosing(int $halfHours): self
    {
        return new self($halfHours * 30, 0, true);
    }

    public function toDueDate(DateTime $now, DateTime $todayEndOfBusiness): DueDate
    {
        if ($this->isBeforeEndOfBusiness) {
            return new DueDate(
                $todayEndOfBusiness->subtractMinutes($this->minutes)
                    ->subtractDays($this->days)
            );
        }

        return new DueDate(
            $now->addMinutes($this->minutes)->addDays($this->days)
        );
    }
}
