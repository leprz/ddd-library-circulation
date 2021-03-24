<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\BookCheckOut\Application;

use Library\Circulation\Core\LibraryMaterial\Domain\LibraryMaterialId;
use Library\Circulation\Core\Patron\Domain\PatronId;
use Library\Circulation\Core\Patron\Domain\PatronType;
use Library\Circulation\UseCase\BookCheckOut\Domain\BookCheckOutDataInterface;

/**
 * @package Library\Circulation\UseCase\BookCheckOut\Application
 */
class BookCheckOutCommand implements BookCheckOutDataInterface
{
    public function __construct(
        private LibraryMaterialId $libraryMaterialId,
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

    public function getLibraryMaterialId(): LibraryMaterialId
    {
        return $this->libraryMaterialId;
    }
}
