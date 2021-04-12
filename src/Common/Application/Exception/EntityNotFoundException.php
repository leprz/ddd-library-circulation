<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Application\Exception;

class EntityNotFoundException extends NotFoundException
{
    public static function identifiedBy(string $className, string $id): self
    {
        $prettyClassName = self::convertToPrettyClassName($className);

        return new self(sprintf('Entity [%s:%s] not found.', $prettyClassName, $id));
    }

    private static function convertToPrettyClassName(string $className): string
    {
        return strtolower(
            preg_replace(
                "/([a-z])([A-Z])/",
                "$1 $2",
                substr($className, strrpos($className, '\\') + 1)
            )
        );
    }
}
