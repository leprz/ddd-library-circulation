<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\ReturnConfirmation;

use Library\Circulation\Common\Domain\LibraryMaterial\LibraryMaterialId;
use Library\Circulation\Common\Domain\Patron\PatronId;
use Library\Circulation\Common\Domain\ValueObject\DateTime;
use Library\Circulation\Common\Domain\ValueObject\DueDate;

class ReturnConfirmationConstructorParameter implements ReturnConfirmationConstructorParameterInterface
{
    public function __construct(
        private ReturnConfirmationId $id,
        private PatronId $borrowerId,
        private LibraryMaterialId $materialId,
        private DueDate $scheduledReturnDate,
        private DateTime $returnedAt
    ) {
    }

    public function getReturnConfirmationId(): ReturnConfirmationId
    {
        return $this->id;
    }

    public function getMaterialId(): LibraryMaterialId
    {
        return $this->materialId;
    }

    public function getBorrowerId(): PatronId
    {
        return $this->borrowerId;
    }

    public function getScheduledReturnDate(): DueDate
    {
        return $this->scheduledReturnDate;
    }

    public function getReturnedAt(): DateTime
    {
        return $this->returnedAt;
    }
}
