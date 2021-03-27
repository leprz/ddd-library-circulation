<?php
declare(strict_types=1);

namespace Library\Circulation\Common\Infrastructure\Date\Adapter;

use Aeon\Calendar\Gregorian\DateTime;
use Aeon\Calendar\Gregorian\Time;
use Library\Circulation\Common\Application\Date\Builder\DateTimeBuilderInterface;
use Library\Circulation\Common\Application\Exception\InvalidArgumentException;
use Library\Circulation\Common\Domain\ValueObject\Date;
use Library\Circulation\Common\Domain\ValueObject\DateTime as DomainDateTime;

class DateTimeAdapter extends DomainDateTime implements DateTimeBuilderInterface
{
    private DateTime $dateTime;

    public function __construct(DateTime $dateTime)
    {
        $this->dateTime = $dateTime;
    }

    public static function fromString(string $date): self
    {
        try {
            return new self(DateTime::fromString($date));
        } catch (\Aeon\Calendar\Exception\InvalidArgumentException $e) {
            throw new InvalidArgumentException($e->getMessage());
        }
    }

    public function __toString(): string
    {
        return $this->dateTime->toISO8601();
    }

    public function format(string $format): string
    {
        return $this->dateTime->format($format);
    }

    public function addDays(int $getLoanPeriodDays): DomainDateTime
    {
        return new self($this->dateTime->addDays($getLoanPeriodDays));
    }

    public function asDate(): Date
    {
        return new DateAdapter($this->dateTime);
    }

    public function isBeforeOrEqual(DomainDateTime $dateTime): bool
    {
        return $this->dateTime->isBeforeOrEqual($dateTime->getDate());
    }

    public function isAfterOrEqual(DomainDateTime $dateTime): bool
    {
        return $this->dateTime->isAfterOrEqual($dateTime->getDate());
    }

    public function subtractMinutes($minutes): self
    {
        return new self($this->dateTime->subMinutes($minutes));
    }

    public function subtractDays(int $days): self
    {
        return new self($this->dateTime->subDays($days));
    }

    public function addMinutes(int $minutes): self
    {
        return new self($this->dateTime->addMinutes($minutes));
    }

    public function setTime(int $hour, int $minute, int $second): self
    {
        try {
            return new self($this->dateTime->setTime(new Time($hour, $minute, $second)));
        } catch (\Aeon\Calendar\Exception\InvalidArgumentException $e) {
            throw new \Library\Circulation\Common\Domain\Exception\InvalidArgumentException($e->getMessage());
        }
    }

    public function equals(DomainDateTime $dateTime): bool
    {
        return $this->dateTime->isEqual($dateTime->getDate());
    }

    protected function getDate(): DateTime
    {
        return $this->dateTime;
    }
}
