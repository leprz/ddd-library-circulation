<?php

declare(strict_types=1);

namespace Library\Circulation\Core\ReturnConfirmation\Domain;

use Library\Circulation\Common\Domain\ValueObject\DateTime;
use Library\Circulation\Common\Domain\ValueObject\DueDate;
use Library\Circulation\Common\Domain\ValueObject\ReturnDateTime;
use Library\Circulation\Core\LibraryMaterial\Domain\LibraryMaterialId;
use Library\Circulation\Core\Patron\Domain\PatronId;
use Library\Circulation\Core\ReturnConfirmation\Application\ReturnConfirmationRepositoryInterface;

/**
 * @package Library\Circulation\Core\ReturnConfirmation\Domain
 */
class ReturnConfirmation
{
    private ReturnConfirmationId $id;
    private LibraryMaterialId $materialId;
    private PatronId $borrowerId;
    private DueDate $scheduledReturnDate;
    private ReturnDateTime $returnedAt;

    /**
     * @param \Library\Circulation\Core\ReturnConfirmation\Domain\ReturnConfirmationConstructorParameterInterface
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
        ReturnDateTime $returnedAt
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

    public function exists(ReturnConfirmationRepositoryInterface $returnConfirmationRepository): bool
    {
        return $returnConfirmationRepository->exists($this->id);
    }

    protected function getBorrowerId(): PatronId
    {
        return $this->borrowerId;
    }
}
