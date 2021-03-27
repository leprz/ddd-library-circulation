<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\BookCheckOut\Domain;

use Library\Circulation\Common\Application\Exception\InvalidArgumentException;
use Library\Circulation\Common\Domain\CheckOut\CheckOutPolicy;
use Library\Circulation\Common\Domain\ValueObject\DateTime;
use Library\Circulation\Common\Domain\ValueObject\DueDate;
use Library\Circulation\Core\Book\Domain\Error\ItemsLimitExceededErrorException;
use Library\Circulation\Core\Book\Domain\Privilege\BooksPrivileges;
use Library\Circulation\Core\Book\Domain\Privilege\BooksPrivilegesForFaculty;
use Library\Circulation\Core\Book\Domain\Privilege\BooksPrivilegesForGraduateStudents;
use Library\Circulation\Core\Book\Domain\Privilege\BooksPrivilegesForUndergraduateStudents;
use Library\Circulation\Core\Patron\Domain\PatronType;

class BookCheckOutPolicy extends CheckOutPolicy
{
    /**
     * @var \Library\Circulation\Core\Book\Domain\Privilege\BooksPrivileges[]
     */
    private array $booksPrivileges = [];

    public function __construct()
    {
        $this->booksPrivileges[] = new BooksPrivilegesForFaculty();
        $this->booksPrivileges[] = new BooksPrivilegesForGraduateStudents();
        $this->booksPrivileges[] = new BooksPrivilegesForUndergraduateStudents();
    }

    private function findPrivilegesForPatronType(PatronType $patronType): BooksPrivileges
    {
        foreach ($this->booksPrivileges as $privilege) {
            if ($privilege->isAppliedForPatronType($patronType)) {
                return $privilege;
            }
        }
        throw new InvalidArgumentException(
            sprintf('No privileges found for patron type [%s]', (string)$patronType)
        );
    }

    public function calculateLoanDueDate(DateTime $borrowedAt, PatronType $patronType): DueDate
    {
        return new DueDate(
            $borrowedAt->addDays(
                $this->findPrivilegesForPatronType($patronType)->getLoanPeriodDays()
            )
        );
    }

    /**
     * @param \Library\Circulation\Core\Patron\Domain\PatronType $patronType
     * @param int $alreadyBorrowedItemsNumber
     * @param int $alreadyOverdueItemsNumber
     * @throws \Library\Circulation\Core\Book\Domain\Error\ItemsLimitExceededErrorException
     */
    public function assertPatronHasReachedItemsLimit(
        PatronType $patronType,
        int $alreadyBorrowedItemsNumber,
        int $alreadyOverdueItemsNumber
    ): void {
        $privileges = $this->findPrivilegesForPatronType($patronType);

        if ($alreadyBorrowedItemsNumber > $privileges->getItemsLimit()) {
            throw ItemsLimitExceededErrorException::forNotOverdue();
        }

        if ($alreadyOverdueItemsNumber > $privileges->getOverdueItemsLimit()) {
            throw ItemsLimitExceededErrorException::forOverdue();
        }
    }
}
