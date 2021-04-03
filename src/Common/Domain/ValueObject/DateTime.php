<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\ValueObject;

abstract class DateTime
{
    abstract public function __toString(): string;

    abstract public function format(string $format): string;

    abstract public function addDays(int $getLoanPeriodDays): self;

    abstract public function asDate(): Date;

    abstract public function isBeforeOrEqual(DateTime $dateTime): bool;

    abstract public function isAfterOrEqual(DateTime $dateTime): bool;

    abstract public function equals(DateTime $dateTime): bool;

    abstract public function subtractMinutes(int $minutes): self;

    abstract public function subtractDays(int $days): self;

    abstract public function addMinutes(int $minutes): self;

    abstract public function setTime(int $hour, int $minute, int $second): self;

    abstract protected function getDate(): mixed;
}
