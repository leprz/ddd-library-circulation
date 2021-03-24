<?php

declare(strict_types=1);

namespace Library\Circulation\Core\LibraryCard\Domain;

use Library\Circulation\Common\Domain\ValueObject\DueDate;
use Library\Circulation\Core\LibraryMaterial\Domain\LibraryMaterialId;
use Library\Circulation\Core\Patron\Domain\PatronId;

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
