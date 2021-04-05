<?php

declare(strict_types=1);

namespace Library\Circulation\Core\ReturnConfirmation\Domain;

use Library\Circulation\Common\Domain\ValueObject\DateTime;
use Library\Circulation\Common\Domain\ValueObject\DueDate;
use Library\Circulation\Common\Domain\ValueObject\ReturnDateTime;
use Library\Circulation\Core\LibraryMaterial\Domain\LibraryMaterialId;
use Library\Circulation\Core\Patron\Domain\PatronId;

/**
 * @package Library\Circulation\Core\ReturnConfirmation\Domain
 */
interface ReturnConfirmationConstructorParameterInterface
{
    public function getReturnConfirmationId(): ReturnConfirmationId;

    public function getMaterialId(): LibraryMaterialId;

    public function getBorrowerId(): PatronId;

    public function getScheduledReturnDate(): DueDate;

    public function getReturnedAt(): ReturnDateTime;
}
