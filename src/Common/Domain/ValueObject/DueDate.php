<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\ValueObject;

class DueDate
{
    public function __construct(private DateTime $date)
    {
    }

    public function toDateTime(): DateTime
    {
        return $this->date;
    }
}
