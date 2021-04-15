<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Application\Trace;

use Library\Circulation\Common\Domain\ValueObject\Traits\UuidTrait;

class RequestId
{
    use UuidTrait;
}
