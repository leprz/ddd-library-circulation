<?php

declare(strict_types=1);

namespace Library\Circulation\Core\Book\Domain;

class BookConstructorParameter implements BookConstructorParameterInterface
{
    public function __construct(private bool $inLibraryUseOnly)
    {
    }

    public function isForInLibraryUseOnly(): bool
    {
        return $this->inLibraryUseOnly;
    }
}
