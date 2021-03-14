<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\ValueObject;

abstract class DateTime
{
    abstract public function __toString(): string;

    abstract public function format(string $format): string;

    abstract public function addDays(int $getLoanPeriodDays): self;

    abstract public function asDate(): Date;
}
