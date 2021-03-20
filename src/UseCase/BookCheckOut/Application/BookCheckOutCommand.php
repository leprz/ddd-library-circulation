<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\BookCheckOut\Application;

use Library\Circulation\Common\Domain\LibraryMaterial\LibraryMaterialId;
use Library\Circulation\Common\Domain\Patron\PatronId;
use Library\Circulation\Common\Domain\Patron\PatronType;
use Library\Circulation\UseCase\BookCheckOut\Domain\BookCheckOutDataInterface;

/**
 * @package Library\Circulation\UseCase\BookCheckOut\Application
 */
class BookCheckOutCommand implements BookCheckOutDataInterface
{
    public function __construct(
        private LibraryMaterialId $bookLibraryCardId,
        private PatronId $patronId,
        private PatronType $borrowerType,
    ) {
    }

    public function getBorrowerId(): PatronId
    {
        return $this->patronId;
    }

    public function getBorrowerType(): PatronType
    {
        return $this->borrowerType;
    }

    public function getBookLibraryCardId(): LibraryMaterialId
    {
        return $this->bookLibraryCardId;
    }
}
