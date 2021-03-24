<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\ValueObject\Traits;

use InvalidArgumentException;
use Library\SharedKernel\Domain\ValueObject\UuidV4Trait;

trait UuidTrait
{
    use UuidV4Trait {
        equals as _equals;
    }

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

    public function equals(self $uuid): bool
    {
        return $this->_equals($uuid);
    }
}
