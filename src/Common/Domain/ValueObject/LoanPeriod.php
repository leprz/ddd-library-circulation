<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\ValueObject;

class LoanPeriod
{
    private int $minutes;
    private int $days;
    private bool $isBeforeEndOfBusiness;
    private bool $isReturnMandatoryWithinSameBusinessDay;

    private function __construct(
        int $minutes,
        int $days,
        bool $isBeforeEndOfBusiness,
        bool $isReturnMandatoryForTheSameDay
    ) {
        $this->minutes = $minutes;
        $this->days = $days;
        $this->isBeforeEndOfBusiness = $isBeforeEndOfBusiness;
        $this->isReturnMandatoryWithinSameBusinessDay = $isReturnMandatoryForTheSameDay;
    }

    public static function halfHoursBeforeClosing(int $halfHours): self
    {
        return new self($halfHours * 30, 0, true, true);
    }

    public static function days(int $days): self
    {
        return new self(0, $days, false, false);
    }

    public static function hours(int $int): self
    {
        return new self($int * 60, 0, false, true);
    }

    public function toDueDate(DateTime $now, DateTime $todayEndOfBusiness): DueDate
    {
        if ($this->isBeforeEndOfBusiness) {
            return new DueDate(
                $todayEndOfBusiness->subtractMinutes($this->minutes)
            );
        }

        $dueDate = new DueDate(
            $now->addMinutes($this->minutes)->addDays($this->days)
        );

        $halfHourBeforeEndOfBusiness = $todayEndOfBusiness->subtractMinutes(30);

        if (!$this->isReturnMandatoryWithinSameBusinessDay) {
            return $dueDate;
        }

        if ($dueDate->isBefore($halfHourBeforeEndOfBusiness)) {
            return $dueDate;
        }

        return new DueDate($halfHourBeforeEndOfBusiness);
    }
}
