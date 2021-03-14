<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Application\Date\Builder;

use Library\Circulation\Common\Domain\ValueObject\DateTime;

interface DateTimeBuilderInterface
{
    /**
     * @param string $date
     * @return \Library\Circulation\Common\Domain\ValueObject\DateTime
     * @throws \InvalidArgumentException
     */
    public static function fromString(string $date): DateTime;
}
