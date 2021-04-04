<?php

declare(strict_types=1);

namespace Library\Circulation\Tests\Behat;

use Behat\Behat\Context\Context;
use Library\Circulation\Common\Infrastructure\Date\DateTimeBuilder;
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
    private BookMother $book;
    private BookCheckInActionInterface $checkInAction;
    private ReturnConfirmation $returnConfirmation;
    private MockObject|LibraryCardPersistenceInterface $libraryCardPersistenceMock;
    private LibraryCard $savedLibraryCard;

    /**
     * @Given /^There is a book borrowed by me$/
     */
    public function thereIsABookBorrowedByMe(): void
    {
        $this->book = BookMother::borrowedByDefaultPatron();
    }

    /**
     * @When /^I check-in this book$/
     */
    public function iReturnThisBook(): void
    {
        $this->returnConfirmation = $this->book->checkIn(
            new BookCheckInCommand(
                BookMother::default(),
                DateTimeBuilder::fromString('2020-01-01 10:00:00')
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

    protected function setUp(): void
    {
        $this->libraryCardPersistenceMock = $this->bindMock(LibraryCardPersistenceInterface::class);
        $this->libraryCardPersistenceMock->method('save')->willReturnCallback(
            function (LibraryCard $libraryCard) {
                $this->savedLibraryCard = $libraryCard;
            }
        );

        $this->checkInAction = $this->resolve(BookCheckInActionInterface::class);
    }
}
