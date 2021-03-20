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
class ReturnConfirmation
{
    private ReturnConfirmationId $id;
    private LibraryMaterialId $materialId;
    private PatronId $borrowerId;
    private DueDate $scheduledReturnDate;
    private DateTime $returnedAt;

    /**
     * @param \Library\Circulation\Common\Domain\ReturnConfirmation\ReturnConfirmationConstructorParameterInterface
     */
    protected function __construct(ReturnConfirmationConstructorParameterInterface $data)
    {
        $this->id = $data->getReturnConfirmationId();
        $this->materialId = $data->getMaterialId();
        $this->borrowerId = $data->getBorrowerId();
        $this->scheduledReturnDate = $data->getScheduledReturnDate();
        $this->returnedAt = $data->getReturnedAt();
    }

    public static function create(
        ReturnConfirmationId $id,
        PatronId $borrowerId,
        LibraryMaterialId $materialId,
        DueDate $dueDate,
        DateTime $returnedAt
    ): self {
        return new self(
            new ReturnConfirmationConstructorParameter(
                $id,
                $borrowerId,
                $materialId,
                $dueDate,
                $returnedAt,
            )
        );
    }
}
