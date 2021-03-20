<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\BookCheckOut\Domain;

use Library\Circulation\Common\Application\Exception\InvalidArgumentException;
use Library\Circulation\Common\Domain\Book\Privilege\BooksPrivileges;
use Library\Circulation\Common\Domain\Book\Privilege\BooksPrivilegesForFaculty;
use Library\Circulation\Common\Domain\Book\Privilege\BooksPrivilegesForGraduateStudents;
use Library\Circulation\Common\Domain\Book\Privilege\BooksPrivilegesForUndergraduateStudents;
use Library\Circulation\Common\Domain\Patron\PatronType;
use Library\Circulation\Common\Domain\ValueObject\DateTime;
use Library\Circulation\Common\Domain\ValueObject\DueDate;

class BookCheckOutPolicy implements LibraryCardLoanPolicyInterface
{
    /**
     * @var \Library\Circulation\Common\Domain\Book\Privilege\BooksPrivileges[]
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

    public function assertPatronDoNotViolateFinancialRules(float $balance): void
    {
        if ($balance < 0) {
            // TODO throw Error
        }
    }

    public function assertPatronHasReachedItemsLimit(
        PatronType $patronType,
        int $alreadyBorrowedBooksNumber,
        int $alreadyOverdueBooksNumber
    ): void {
        $privileges = $this->findPrivilegesForPatronType($patronType);

        if ($alreadyBorrowedBooksNumber >= $privileges->getItemsLimit()) {
            // throw Error
        }

        if ($alreadyOverdueBooksNumber >= $privileges->getOverdueItemsLimit()) {
            // throw Error
        }
    }
}