<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\ReturnConfirmation;

use Library\Circulation\Common\Domain\LibraryMaterial\LibraryMaterialId;
use Library\Circulation\Common\Domain\Patron\PatronId;
use Library\Circulation\Common\Domain\ValueObject\DateTime;
use Library\Circulation\Common\Domain\ValueObject\DueDate;

/**
 * @package Library\Circulation\Common\Domain\ReturnConfirmation
 */
interface ReturnConfirmationConstructorParameterInterface
{
    public function getReturnConfirmationId(): ReturnConfirmationId;

    public function getMaterialId(): LibraryMaterialId;

    public function getBorrowerId(): PatronId;

    public function getScheduledReturnDate(): DueDate;

    public function getReturnedAt(): DateTime;
}
