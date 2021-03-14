<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Application\Date;

use Library\Circulation\Common\Domain\ValueObject\Date;
use Library\Circulation\Common\Domain\ValueObject\DateTime;

interface ClockInterface
{
    public function now(): DateTime;

    public function today(): Date;
}
