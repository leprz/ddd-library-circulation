<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Application\Date\Builder;

use RuntimeException;

final class AdapterNotInitializedException extends RuntimeException
{
    /**
     * @param string $className
     * @return self
     */
    public static function fromClassName(string $className): self
    {
        return new self(sprintf('Adapter in [%s] has been not initialized', $className));
    }
}
