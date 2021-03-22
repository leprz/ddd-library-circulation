<?php

declare(strict_types=1);

namespace Library\Circulation\Tests\Behat;

use Behat\Behat\Tester\Exception\PendingException;
use Library\Circulation\Common\Domain\LibraryCard\LibraryCard;
use Library\Circulation\Common\Domain\Patron\PatronId;
use Library\Circulation\Common\Domain\Patron\PatronType;
use Library\Circulation\Common\Domain\ValueObject\DateTime;
use Library\Circulation\Common\Infrastructure\Date\DateTimeBuilder;
use Library\Circulation\Tests\Common\TestData\BookMother;
use Library\Circulation\Tests\Common\TestData\LibraryCardMother;
use Library\Circulation\Tests\Common\TestData\PatronMother;
use Library\Circulation\UseCase\BookCheckOut\Application\BookCheckOutCommand;
use Library\Circulation\UseCase\BookCheckOut\Domain\BookCheckOutActionInterface;
use Library\Circulation\UseCase\BookCheckOut\Domain\BookCheckOutPolicy;
use PHPUnit\Framework\Assert;

class BookContext extends BehavioralTestCase
{
    /**
     * @var \Library\Circulation\Tests\Common\TestData\BookMother
     */
    private BookMother $book;
    private LibraryCard $libraryCard;
    private DateTime $borrowedAt;
    private PatronId $myId;

    public function __construct(
        private BookCheckOutActionInterface $bookCheckOutAction,
        private BookCheckOutPolicy $bookCheckOutPolicy
    ) {
    }

    /**
     * @Given /^There is available book$/
     */
    public function thereIsAvailableBook(): void
    {
        $this->book = BookMother::available();
    }

    /**
     * @When /^Me as a Graduate student check out this book$/
     */
    public function meAsAGraduateStudentCheckOutThisBook(): void
    {
        $this->checkOutAs(PatronType::graduateStudent());
    }

    /**
     * @When /^Me as a undergraduate student check out this book$/
     */
    public function meAsAUndergraduateStudentCheckOutThisBook(): void
    {
        $this->checkOutAs(PatronType::undergraduateStudent());
    }

    /**
     * @When /^Me as a faculty check out this book$/
     */
    public function meAsAFacultyCheckOutThisBook(): void
    {
        $this->checkOutAs(PatronType::faculty());
    }

    private function checkOutAs(PatronType $patronType): void
    {
        $this->borrowedAt = DateTimeBuilder::fromString('2020-01-01 10:00');
        $this->myId = PatronMother::default();

        $this->libraryCard = $this->book->checkOut(
            new BookCheckOutCommand(
                BookMother::default(),
                $this->myId,
                $patronType
            ),
            $this->borrowedAt,
            $this->bookCheckOutAction,
            $this->bookCheckOutPolicy
        );
    }

    /**
     * @Then /^This book is borrowed by me$/
     */
    public function thisBookIsBorrowedByMe(): void
    {
        Assert::assertEquals(
            $this->myId,
            LibraryCardMother::readBorrowerId($this->libraryCard)
        );
    }

    /**
     * @Given /^I got (\d+) days to return this book$/
     */
    public function iGotDaysToReturnThisBook(int $daysUntilDueDate): void
    {
        Assert::assertEquals(
            $this->borrowedAt->addDays($daysUntilDueDate),
            LibraryCardMother::readDueDate($this->libraryCard)->toDateTime()
        );
    }
}
