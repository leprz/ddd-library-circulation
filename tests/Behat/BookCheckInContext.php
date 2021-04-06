<?php

declare(strict_types=1);

namespace Library\Circulation\Tests\Behat;

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Library\Circulation\Common\Domain\DomainEvent\DomainEventStore;
use Library\Circulation\Common\Domain\DomainEvent\DomainEventStoreInterface;
use Library\Circulation\Common\Domain\ValueObject\Date;
use Library\Circulation\Common\Domain\ValueObject\DueDate;
use Library\Circulation\Common\Domain\ValueObject\ReturnDateTime;
use Library\Circulation\Common\Infrastructure\Date\DateBuilder;
use Library\Circulation\Common\Infrastructure\Date\DateTimeBuilder;
use Library\Circulation\Core\Book\Domain\Book;
use Library\Circulation\Core\LibraryCard\Application\LibraryCardPersistenceInterface;
use Library\Circulation\Core\LibraryCard\Domain\LibraryCard;
use Library\Circulation\Core\ReturnConfirmation\Domain\ReturnConfirmation;
use Library\Circulation\Tests\BehavioralTestCase;
use Library\Circulation\Tests\Common\TestData\BookMother;
use Library\Circulation\Tests\Common\TestData\LibraryCardMother;
use Library\Circulation\Tests\Common\TestData\PatronMother;
use Library\Circulation\Tests\Common\TestData\ReturnConfirmationMother;
use Library\Circulation\UseCase\BookCheckIn\Application\BookCheckInCommand;
use Library\Circulation\UseCase\BookCheckIn\Domain\BookCheckInActionInterface;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\MockObject\MockObject;

class BookCheckInContext extends BehavioralTestCase implements Context
{
    use CurrentTimeContext;

    private BookMother $book;
    private BookCheckInActionInterface $checkInAction;
    private ReturnConfirmation $returnConfirmation;
    private MockObject|LibraryCardPersistenceInterface $libraryCardPersistenceMock;
    private LibraryCard $savedLibraryCard;
    private ?DueDate $bookDueDate = null;
    private DomainEventStore $eventStore;

    /**
     * @Given /^There is a book borrowed by me$/
     */
    public function thereIsABookBorrowedByMe(): void
    {
        $this->book = BookMother::borrowed(dueDate: $this->bookDueDate);
    }

    protected function todayIs(): Date
    {
        return DateBuilder::fromString('2020-01-01');
    }

    /**
     * @When /^I check-in this book$/
     */
    public function iReturnThisBook(): void
    {
        if ($this->now) {
            $now = $this->now;
        } else {
            $now = $this->todayIs()->toDateTime();
        }

        $this->returnConfirmation = $this->book->checkIn(
            new BookCheckInCommand(
                BookMother::default(),
                PatronMother::default(),
                new ReturnDateTime($now)
            ),
            $this->checkInAction
        );
    }

    /**
     * @Then /^This book is returned by me$/
     */
    public function thisBookIsReturnedByMe(): void
    {
        Assert::assertTrue(
            ReturnConfirmationMother::readBorrowerId($this->returnConfirmation)->equals(
                PatronMother::default()
            )
        );
    }

    /**
     * @Given /^It can be borrowed again$/
     */
    public function itCanBeBorrowedAgain(): void
    {
        Assert::assertFalse(
            LibraryCardMother::readIsLent($this->savedLibraryCard)
        );
    }

    /**
     * @Given /^Due date of this book is at (.*)$/
     * @param string $bookDueDate
     */
    public function dueDateOfThisBookIsAt202001(string $bookDueDate): void
    {
        $this->bookDueDate = new DueDate(DateTimeBuilder::fromString($bookDueDate));
    }

    /**
     * @Given /^This book is (\d+) days overdue$/
     * @param string $overDueDays
     */
    public function thisBookIsDaysOverdue(string $overDueDays): void
    {
        $events = $this->eventStore->filterByEmitter(BookMother::class);
        Assert::assertNotEmpty($events);
        /** @var \Library\SharedKernel\Domain\Event\Circulation\BookCheckedInOverDueEvent $event */
        $event = array_pop($events);
        Assert::assertStringStartsWith("$overDueDays:", $event->getOverDueTimePeriod());
    }

    protected function setUp(): void
    {
        $this->libraryCardPersistenceMock = $this->bindMock(LibraryCardPersistenceInterface::class);
        $this->libraryCardPersistenceMock->method('save')->willReturnCallback(
            function (LibraryCard $libraryCard) {
                $this->savedLibraryCard = $libraryCard;
            }
        );

        $this->eventStore = new DomainEventStore();
        $this->bindInstance(DomainEventStore::class, $this->eventStore);

        $this->checkInAction = $this->resolve(BookCheckInActionInterface::class);
    }
}
