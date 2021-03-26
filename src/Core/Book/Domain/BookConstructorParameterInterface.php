<?php

declare(strict_types=1);

namespace Library\Circulation\Core\Book\Domain;

/**
 * @package Library\Circulation\Core\Book\Domain
 */
interface BookConstructorParameterInterface
{
    public function isForInLibraryUseOnly(): bool;
}
