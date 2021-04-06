<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\BookCheckOut\Infrastructure;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Library\Circulation\Common\Domain\ValueObject\DueDate;
use Library\Circulation\Common\Infrastructure\DataFixtures\ReferenceFixture;
use Library\Circulation\Common\Infrastructure\Date\DateTimeBuilder;

class BookCheckOutFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $this->checkOut(
            ReferenceFixture::$BOOK_CHECKED_OUT,
            ReferenceFixture::$PATRON_ID,
            '2020-01-01',
            $manager
        );

        $manager->flush();
    }

    private function checkOut(string $bookId, string $borrowerId, string $dueDate, ObjectManager $manager): void
    {
        /** @var \Library\Circulation\Core\Book\Infrastructure\BookEntity $book */
        $book = $this->getReference($bookId);

        /** @var \Library\Circulation\Core\Patron\Infrastructure\PatronEntity $borrower */
        $borrower = $this->getReference($borrowerId);

        $book->setBorrower($borrower);
        $book->setDueDate(new DueDate(DateTimeBuilder::fromString($dueDate)));
    }
}
