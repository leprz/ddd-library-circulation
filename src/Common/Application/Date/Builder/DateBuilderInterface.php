<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Application\Date\Builder;

use Library\Circulation\Common\Domain\ValueObject\Date;

interface DateBuilderInterface
{
    /**
     * @param string $date
     * @return \Library\Circulation\Common\Domain\ValueObject\Date
     * @throws \InvalidArgumentException
     */
    public static function fromString(string $date): Date;
}
