<?php

declare(strict_types=1);

namespace Library\Circulation\Tests\Common\TestData;

use Library\Circulation\Common\Domain\ValueObject\DueDate;
use Library\Circulation\Common\Infrastructure\Date\DateTimeBuilder;
use Library\Circulation\Core\LibraryCard\Domain\LibraryCard;
use Library\Circulation\Core\LibraryCard\Domain\LibraryCardConstructorParameter;
use Library\Circulation\Core\LibraryMaterial\Domain\LibraryMaterialId;
use Library\Circulation\Core\Patron\Domain\PatronId;

class LibraryCardMother extends LibraryCard
{
    public static function notBorrowed(): LibraryCard
    {
        $constructor = new LibraryCardConstructorParameter(
            LibraryMaterialId::fromString('5F5D4F7F-5E12-4BA2-8C04-EABB7E537FD3')
        );
        return new LibraryCard($constructor);
    }

    public static function borrowed(PatronId $patronId, ?DueDate $dueDate = null): LibraryCardMother
    {
        $constructor = new LibraryCardConstructorParameter(
            BookMother::default()
        );

        $constructor->setBorrowerId($patronId);

        if ($dueDate) {
            $constructor->setDueDate($dueDate);
        } else {
            $constructor->setDueDate(new DueDate(DateTimeBuilder::fromString('2020-01-01')));
        }

        return new self($constructor);
    }

    public static function readBorrowerId(LibraryCard $libraryCard): ?PatronId
    {
        return $libraryCard->getBorrowerId();
    }

    public static function readDueDate(LibraryCard $libraryCard): ?DueDate
    {
        return $libraryCard->getDueDate();
    }

    public static function readIsLent(LibraryCard $libraryCard): bool
    {
        return $libraryCard->isLent();
    }
}
