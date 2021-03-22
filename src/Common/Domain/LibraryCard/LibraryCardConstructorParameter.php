<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\LibraryCard;

use Library\Circulation\Common\Domain\LibraryMaterial\LibraryMaterialId;
use Library\Circulation\Common\Domain\Patron\PatronId;
use Library\Circulation\Common\Domain\ValueObject\DueDate;

class LibraryCardConstructorParameter implements LibraryCardConstructorParameterInterface
{
    private ?PatronId $borrowerId = null;
    private ?DueDate $dueDate = null;

    public function __construct(
        private LibraryMaterialId $libraryMaterialId,
    ) {
    }

    public function libraryMaterialId(): LibraryMaterialId
    {
        return $this->libraryMaterialId;
    }

    public function getBorrowerId(): ?PatronId
    {
        return $this->borrowerId;
    }

    public function getDueDate(): ?DueDate
    {
        return $this->dueDate;
    }

    public function setBorrowerId(?PatronId $borrowerId): void
    {
        $this->borrowerId = $borrowerId;
    }

    public function setDueDate(?DueDate $dueDate): void
    {
        $this->dueDate = $dueDate;
    }
}
