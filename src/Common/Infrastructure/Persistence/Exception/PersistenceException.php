<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Infrastructure\Persistence\Exception;

use LogicException;

class PersistenceException extends LogicException
{
    public static function saveUsedInsteadOfAdd(): self
    {
        return new self('Trying to save non existing resource. Please use add instead.');
    }
}
