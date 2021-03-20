<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\LibraryCard;

use Library\Circulation\Common\Domain\LibraryMaterial\LibraryMaterialId;
use Library\Circulation\Common\Domain\Patron\PatronId;
use Library\Circulation\Common\Domain\ValueObject\DueDate;

/**
 * @package Library\Circulation\Common\Domain\LibraryCard
 */
interface LibraryCardConstructorParameterInterface
{
    public function libraryCardId(): LibraryMaterialId;

    public function getBorrowerId(): ?PatronId;

    public function getDueDate(): ?DueDate;
}