<?php

declare(strict_types=1);

namespace Library\Circulation\Core\Book\Domain;

use Library\SharedKernel\Domain\ValueObject\UuidV4Trait;

/**
 * @package Library\Circulation\Core\Book\Domain
 */
class CallNumber
{
    use UuidV4Trait;
}
