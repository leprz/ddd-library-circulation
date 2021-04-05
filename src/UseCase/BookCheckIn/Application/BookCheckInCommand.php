<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\BookCheckIn\Application;

use Library\Circulation\Common\Domain\ValueObject\DateTime;
use Library\Circulation\Common\Domain\ValueObject\ReturnDateTime;
use Library\Circulation\Core\LibraryMaterial\Domain\LibraryMaterialId;
use Library\Circulation\UseCase\BookCheckIn\Domain\BookCheckInDataInterface;

/**
 * @package Library\Circulation\UseCase\BookCheckIn\Application
 */
class BookCheckInCommand implements BookCheckInDataInterface
{
    public function __construct(private LibraryMaterialId $materialId, private ReturnDateTime $returnedAt)
    {
    }

    public function getLibraryMaterialId(): LibraryMaterialId
    {
        return $this->materialId;
    }

    public function getReturnedAt(): ReturnDateTime
    {
        return $this->returnedAt;
    }
}
