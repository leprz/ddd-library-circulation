<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\LibraryCard;

use Library\Circulation\Common\Domain\Book\CallNumber;
use Library\Circulation\Common\Domain\Patron\PatronId;
use Library\Circulation\Common\Domain\ValueObject\Date;
use Library\Circulation\Common\Domain\ValueObject\DateTime;
use Library\Circulation\Common\Domain\ValueObject\DueDate;
use Library\Circulation\Common\Domain\ValueObject\LibrarianId;
use Library\Circulation\UseCase\BookCheckOut\Domain\LibraryCardLendDataInterface;
use Library\Circulation\UseCase\BookCheckOut\Domain\LibraryCardLoanPolicyInterface;

/**
 * @package Library\Circulation\Common\Domain\LibraryCard
 */
class LibraryCard
{
    private LibraryCardId $libraryCardId;

    private ?PatronId $borrowerId;

    private ?DueDate $dueDate;

    /**
     * @param \Library\Circulation\Common\Domain\LibraryCard\LibraryCardConstructorParameterInterface
     */
    public function __construct(LibraryCardConstructorParameterInterface $data)
    {
        $this->libraryCardId = $data->libraryCardId();
        $this->borrowerId = $data->getBorrowerId();
        $this->dueDate = $data->getDueDate();
    }

    public function loan(
        LibraryCardLendDataInterface $data,
        DateTime $borrowedAt,
        LibraryCardLoanPolicyInterface $policy
    ): self {
        $this->borrowerId = $data->getBorrowerId();

        $this->dueDate = $policy->calculateLoanDueDate($borrowedAt, $data->getBorrowerType());

        // BookBorrowedEvent
        return $this;
    }

    public function return(): void
    {
        $this->borrowerId = null;

        $this->dueDate = null;
        // BookReturnedEvent
    }
}
