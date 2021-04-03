<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\OtherMaterialUseInLibrary\Application;

use Library\Circulation\Core\LibraryMaterial\Domain\LibraryMaterialId;
use Library\Circulation\Core\Patron\Domain\PatronId;
use Library\Circulation\Core\Patron\Domain\PatronIdentity;
use Library\Circulation\Core\Patron\Domain\PatronType;
use Library\Circulation\UseCase\OtherMaterialUseInLibrary\Domain\OtherMaterialUseInLibraryDataInterface;

/**
 * @package Library\Circulation\UseCase\OtherMaterialUseInLibrary\Application
 */
class OtherMaterialUseInLibraryCommand implements OtherMaterialUseInLibraryDataInterface
{
    public function __construct(
        private LibraryMaterialId $libraryMaterialId,
        private PatronIdentity $patronIdentity,
    ) {
    }

    public function getBorrowerType(): PatronType
    {
        return $this->patronIdentity->getType();
    }

    public function getBorrowerId(): PatronId
    {
        return $this->patronIdentity->getPatronId();
    }

    public function getLibraryMaterialId(): LibraryMaterialId
    {
        return $this->libraryMaterialId;
    }
}
