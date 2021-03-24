<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\Book\Error;

use Library\Circulation\Common\Domain\Error\DomainErrorException;

class BorrowLimitExceededErrorException extends DomainErrorException
{
    public static function forNotOverdue(): self
    {
        return new self("Items limit has been reached. Please return some items first.");
    }

    public static function forOverdue(): self
    {
        return new self("Too many overdue items. Please return items and clear your dues first.");
    }
}
