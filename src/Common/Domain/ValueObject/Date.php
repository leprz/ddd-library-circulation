<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\ValueObject;

abstract class Date
{
    abstract public function __toString(): string;

    abstract public function format(string $format): string;

    abstract public function toDateTime(): DateTime;

    abstract protected function getDate(): mixed;
}
