<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\LibraryMaterial;

use Library\Circulation\Common\Domain\LibraryCard\LibraryCard;

abstract class LibraryMaterial
{
    protected LibraryCard $libraryCard;
}
