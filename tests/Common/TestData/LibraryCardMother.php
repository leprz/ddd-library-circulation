<?php

declare(strict_types=1);

namespace Library\Circulation\Tests\Common\TestData;

use Library\Circulation\Common\Domain\LibraryCard\LibraryCard;
use Library\Circulation\Common\Domain\LibraryCard\LibraryCardConstructorParameter;
use Library\Circulation\Common\Domain\LibraryMaterial\LibraryMaterialId;
use Library\Circulation\Common\Domain\Patron\PatronId;
use Library\Circulation\Common\Domain\ValueObject\DueDate;
use Library\Circulation\Common\Infrastructure\Date\DateTimeBuilder;

class LibraryCardMother extends LibraryCard
{
    public static function notBorrowed(): LibraryCard
    {
        $constructor = new LibraryCardConstructorParameter(
            LibraryMaterialId::fromString('5F5D4F7F-5E12-4BA2-8C04-EABB7E537FD3')
        );
        return new LibraryCard($constructor);
    }

    public static function borrowed(): LibraryCard
    {
        $constructor = new LibraryCardConstructorParameter(
            LibraryMaterialId::fromString('5F5D4F7F-5E12-4BA2-8C04-EABB7E537FD3')
        );

        $constructor->setBorrowerId(PatronMother::default());
        $constructor->setDueDate(new DueDate(DateTimeBuilder::fromString('2020-01-01')));

        return new LibraryCard($constructor);
    }

    public static function readBorrowerId(LibraryCard $libraryCard): PatronId
    {
        return $libraryCard->getBorrowerId();
    }

    public static function readDueDate(LibraryCard $libraryCard): DueDate
    {
        return $libraryCard->getDueDate();
    }
}
