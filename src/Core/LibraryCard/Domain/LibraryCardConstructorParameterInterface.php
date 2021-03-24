<?php

declare(strict_types=1);

namespace Library\Circulation\Core\LibraryCard\Domain;

use Library\Circulation\Common\Domain\ValueObject\DueDate;
use Library\Circulation\Core\LibraryMaterial\Domain\LibraryMaterialId;
use Library\Circulation\Core\Patron\Domain\PatronId;

/**
 * @package Library\Circulation\Core\LibraryCard\Domain
 */
interface LibraryCardConstructorParameterInterface
{
    public function libraryMaterialId(): LibraryMaterialId;

    public function getBorrowerId(): ?PatronId;

    public function getDueDate(): ?DueDate;
}
