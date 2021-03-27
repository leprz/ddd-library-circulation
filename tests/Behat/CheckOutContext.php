<?php

declare(strict_types=1);

namespace Library\Circulation\Tests\Behat;

use Behat\Behat\Context\Context;
use ErrorException;
use Library\Circulation\Common\Domain\ValueObject\DateTime;
use Library\Circulation\Common\Infrastructure\Date\DateTimeBuilder;
use Library\Circulation\Core\Book\Domain\Book;
use Library\Circulation\Core\Finance\Application\FinanceServiceInterface;
use Library\Circulation\Core\LibraryCard\Domain\LibraryCard;
use Library\Circulation\Core\Patron\Domain\PatronId;
use Library\Circulation\Core\Patron\Domain\PatronType;
use Library\Circulation\Core\Satistics\Application\PatronBorrowedBooksStatisticsRepositoryInterface;
use Library\Circulation\Tests\Behat\Exception\ExpectedErrorHasNotBeenThrown;
use Library\Circulation\Tests\BehavioralTestCase;
use Library\Circulation\Tests\Common\TestData\BookMother;
use Library\Circulation\Tests\Common\TestData\LibraryCardMother;
use Library\Circulation\Tests\Common\TestData\PatronMother;
use Library\Circulation\UseCase\BookCheckOut\Application\BookCheckOutCommand;
use Library\Circulation\UseCase\BookCheckOut\Domain\BookCheckOutActionInterface;
use Library\Circulation\UseCase\BookCheckOut\Domain\BookCheckOutPolicy;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\MockObject\MockObject;

class CheckOutContext extends BehavioralTestCase implements Context
{
    private Book $book;
    public LibraryCard $libraryCard;
    public DateTime $borrowedAt;
    public PatronId $myId;
    public ?ErrorException $error = null;
    private BookCheckOutActionInterface $bookCheckOutAction;
    private BookCheckOutPolicy $bookCheckOutPolicy;
    private FinanceServiceInterface|MockObject $patronFinancialServiceMock;
    /**
     * @var \Library\Circulation\Core\Satistics\Application\PatronBorrowedBooksStatisticsRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    private MockObject|PatronBorrowedBooksStatisticsRepositoryInterface $patronBorrowStatisticsRepositoryMock;

    /**
     * @Given /^I got not overdue (.*)$/
     * @param int $borrowedBooksCount
     */
    public function iGotNotOverdue(int $borrowedBooksCount): void
    {
        $this->patronBorrowStatisticsRepositoryMock->method('countBorrowedBy')->willReturn($borrowedBooksCount);
    }

    /**
     * @Given /^There is not available book$/
     */
    public function thereIsNotAvailableBook(): void
    {
        $this->book = BookMother::borrowedByNotDefaultPatron();
    }

    /**
     * @Given /^I got (.*) that are overdue$/
     * @param int $overdueBooksCount
     */
    public function iGotThatAreOverdue(int $overdueBooksCount): void
    {
        $this->patronBorrowStatisticsRepositoryMock->method('countBorrowedOverdueBy')->willReturn($overdueBooksCount);
    }

    /**
     * @Given /^There is book for in\-library use only$/
     */
    public function thereIsBookForInLibraryUseOnly()
    {
        $this->book = BookMother::forInLibraryUseOnly();
    }

    protected function setUp(): void
    {
        $this->patronFinancialServiceMock = $this->bindMock(FinanceServiceInterface::class);
        $this->patronBorrowStatisticsRepositoryMock = $this->bindMock(
            PatronBorrowedBooksStatisticsRepositoryInterface::class
        );
        $this->bookCheckOutPolicy = $this->resolve(BookCheckOutPolicy::class);
        $this->bookCheckOutAction = $this->resolve(BookCheckOutActionInterface::class);
    }

    /**
     * @Given /^There is available book$/
     */
    public function thereIsAvailableBook(): void
    {
        $this->book = BookMother::available();
    }

    /**
     * @When /^Me as a (.*) check out this book$/
     * @param string $patronType
     */
    public function meAsACheckOutThisBook(string $patronType): void
    {
        $this->borrowedAt = DateTimeBuilder::fromString('2020-01-01 10:00');
        $this->myId = PatronMother::default();

        try {
            $this->libraryCard = $this->book->checkOut(
                new BookCheckOutCommand(
                    BookMother::default(),
                    $this->myId,
                    PatronType::fromString($patronType)
                ),
                $this->bookCheckOutAction,
                $this->bookCheckOutPolicy,
                $this->borrowedAt,
            );
        } catch (ErrorException $error) {
            $this->error = $error;
        }
    }

    /**
     * @Then /^This material is borrowed by me$/
     */
    public function thisBookIsBorrowedByMe(): void
    {
        Assert::assertTrue(
            $this->myId->equals(LibraryCardMother::readBorrowerId($this->libraryCard)),
        );
    }

    /**
     * @Given /^I got (.*) days to return it$/
     * @param int $daysUntilDueDate
     */
    public function iGotToReturnThisBook(int $daysUntilDueDate): void
    {
        Assert::assertTrue(
            $this->borrowedAt->addDays($daysUntilDueDate)->equals(
                LibraryCardMother::readDueDate($this->libraryCard)->toDateTime()
            ),
        );
    }

    /**
     * @Then /^I see error says "([^"]*)"$/
     * @param string $errorMessage
     * @throws \Library\Circulation\Tests\Behat\Exception\ExpectedErrorHasNotBeenThrown
     */
    public function iSeeErrorSays(string $errorMessage): void
    {
        if (!$this->error) {
            throw ExpectedErrorHasNotBeenThrown::forExpectedMessage($errorMessage);
        }

        if ($this->error->getMessage() !== $errorMessage) {
            throw ExpectedErrorHasNotBeenThrown::gotActualMessageInstead($this->error->getMessage());
        }
    }

    /**
     * @Given /^My balance is ([-]?\$\d+)$/
     * @param string $balance
     */
    public function patronBalanceIs(string $balance): void
    {
        $balance = (float)filter_var($balance, FILTER_SANITIZE_NUMBER_FLOAT);
        $this->patronFinancialServiceMock->method('getBalanceFor')->willReturn($balance);
    }
}
