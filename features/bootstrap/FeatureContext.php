<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Library\Circulation\Common\Application\Persistence\BookRepositoryInterface;
use Library\Circulation\Common\Domain\Book\Book;
use Library\Circulation\Tests\Common\TestData\BookMother;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /**
     * @var \Library\Circulation\Common\Domain\Book\Book
     */
    private Book $book;

    public function __construct(private BookRepositoryInterface $bookRepository)
    {
    }

    /**
     * @Given /^there is book with ISBN (\d+)$/
     */
    public function thereIsBookWithISBN($arg1)
    {
        return $this->bookRepository->getByISBN();
    }

    /**
     * @When /^I check out this book$/
     */
    public function iCheckOutThisBook()
    {
        throw new PendingException();
    }

    /**
     * @Then /^I see this book on my borrowed books list$/
     */
    public function iSeeThisBookOnMyBorrowedBooksList()
    {
        throw new PendingException();
    }

    /**
     * @Given /^I know the return due date$/
     */
    public function iKnowTheReturnDueDate()
    {
        throw new PendingException();
    }

    /**
     * @Given /^I can walk out from the library with this book$/
     */
    public function iCanWalkOutFromTheLibraryWithThisBook()
    {
        throw new PendingException();
    }

    /**
     * @Given /^there is available book$/
     */
    public function thereIsAvailableBook(): void
    {
        $this->book = $this->bookRepository->getByLibraryCardId(BookMother::default());
    }
}
