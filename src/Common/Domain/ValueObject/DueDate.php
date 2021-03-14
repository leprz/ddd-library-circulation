<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\ValueObject;

class DueDate
{
    public function __construct(private Date $date)
    {
    }

    public function toDate(): Date
    {
        return $this->date;
    }
}
