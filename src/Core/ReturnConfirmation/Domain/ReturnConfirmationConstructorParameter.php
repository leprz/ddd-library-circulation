<?php

declare(strict_types=1);

namespace Library\Circulation\Core\ReturnConfirmation\Domain;

use Library\Circulation\Common\Domain\ValueObject\DateTime;
use Library\Circulation\Common\Domain\ValueObject\DueDate;
use Library\Circulation\Core\LibraryMaterial\Domain\LibraryMaterialId;
use Library\Circulation\Core\Patron\Domain\PatronId;

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
