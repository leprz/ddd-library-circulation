<?php

declare(strict_types=1);

namespace Library\Circulation\Tests\Common\Fake;

use Library\Circulation\Common\Application\Date\ClockInterface;
use Library\Circulation\Common\Domain\ValueObject\Date;
use Library\Circulation\Common\Domain\ValueObject\DateTime;

class ClockStub implements ClockInterface
{
    public function __construct(private DateTime $now)
    {
    }

    public function now(): DateTime
    {
        return $this->now;
    }

    public function today(): Date
    {
        return $this->now->asDate();
    }
}
