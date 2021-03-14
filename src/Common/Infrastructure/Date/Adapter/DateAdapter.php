<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Infrastructure\Date\Adapter;

use Aeon\Calendar\Gregorian\DateTime;
use Aeon\Calendar\Gregorian\Time;
use Library\Circulation\Common\Application\Date\Builder\DateBuilderInterface;
use Library\Circulation\Common\Application\Exception\InvalidArgumentException;
use Library\Circulation\Common\Domain\ValueObject\Date;

class DateAdapter extends Date implements DateBuilderInterface
{
    /**
     * @var \Aeon\Calendar\Gregorian\DateTime
     */
    private DateTime $date;

    public function __construct(DateTime $dateTime)
    {
        $this->date = $dateTime->setTime(new Time(0,0,0));
    }

    public function __toString(): string
    {
        return $this->date->toISO8601();
    }

    public function format(string $format): string
    {
        return $this->date->format($format);
    }

    public static function fromDateTime(\Library\Circulation\Common\Domain\ValueObject\DateTime $dateTime): Date
    {
        return new self(DateTime::fromString((string)$dateTime));
    }

    /**
     * @param string $date
     * @return \Library\Circulation\Common\Domain\ValueObject\Date
     */
    public static function fromString(string $date): Date
    {
        try {
            return new self(DateTime::fromString($date));
        } catch (\Aeon\Calendar\Exception\InvalidArgumentException $e) {
            throw new InvalidArgumentException($e->getMessage());
        }
    }
}
