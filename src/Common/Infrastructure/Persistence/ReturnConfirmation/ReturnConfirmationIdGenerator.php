<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Infrastructure\Persistence\ReturnConfirmation;

use Library\Circulation\Common\Domain\ReturnConfirmation\ReturnConfirmationId;
use Library\SharedKernel\Infrastructure\Persistence\UuidV4GeneratorTrait;

class ReturnConfirmationIdGenerator
{
    use UuidV4GeneratorTrait;

    public function generate(): ReturnConfirmationId
    {
        return ReturnConfirmationId::fromString($this->uuidV4());
    }
}
