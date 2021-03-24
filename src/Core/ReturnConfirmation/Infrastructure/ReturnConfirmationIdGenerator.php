<?php

declare(strict_types=1);

namespace Library\Circulation\Core\ReturnConfirmation\Infrastructure;

use Library\Circulation\Core\ReturnConfirmation\Domain\ReturnConfirmationId;
use Library\SharedKernel\Infrastructure\Persistence\UuidV4GeneratorTrait;

class ReturnConfirmationIdGenerator
{
    use UuidV4GeneratorTrait;

    public function generate(): ReturnConfirmationId
    {
        return ReturnConfirmationId::fromString($this->uuidV4());
    }
}
