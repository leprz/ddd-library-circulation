<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\ValueObject\Traits;

use Library\Circulation\Common\Application\Exception\InvalidArgumentException;
use Library\SharedKernel\Domain\ValueObject\UuidV4Trait;

class UuidTrait
{
    use UuidV4Trait;

    /**
     * @param string $string
     * @return static
     */
    public static function fromString(string $string): static
    {
        try {
            return new static($string);
        } catch (\Library\SharedKernel\Domain\Exception\InvalidArgumentException $e) {
            throw new InvalidArgumentException($e->getMessage());
        }
    }
}
