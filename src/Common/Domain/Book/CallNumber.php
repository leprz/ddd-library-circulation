<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\Book;

use Library\SharedKernel\Domain\ValueObject\UuidV4Trait;

/**
 * @package Library\Circulation\Common\Domain\Book
 */
class CallNumber
{
    use UuidV4Trait;
}
