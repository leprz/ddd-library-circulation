<?php

declare(strict_types=1);

namespace Library\Circulation\Core\LibraryMaterial\Domain;

use Library\Circulation\Core\LibraryCard\Domain\LibraryCard;

abstract class LibraryMaterial
{
    protected LibraryCard $libraryCard;
}
