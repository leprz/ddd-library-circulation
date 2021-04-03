<?php

declare(strict_types=1);

namespace Library\Circulation\Tests\Behat;

use Library\Circulation\Common\Domain\ValueObject\DateTime;
use Library\Circulation\Core\LibraryCard\Domain\LibraryCard;
use Library\Circulation\Core\Patron\Domain\PatronId;
use Library\Circulation\Tests\Common\TestData\LibraryCardMother;
use PHPUnit\Framework\Assert;

trait BorrowContext
{
    public LibraryCard $libraryCard;
    public DateTime $borrowedAt;
    public PatronId $myId;

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
}
