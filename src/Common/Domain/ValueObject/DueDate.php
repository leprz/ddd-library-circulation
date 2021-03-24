<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\ValueObject;

class DueDate
{
    public function __construct(private DateTime $dueDate)
    {
    }

    public function toDateTime(): DateTime
    {
        return $this->dueDate;
    }
}
