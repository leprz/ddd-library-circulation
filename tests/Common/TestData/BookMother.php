<?php

declare(strict_types=1);

namespace Library\Circulation\Tests\Common\TestData;

use Library\Circulation\Common\Domain\ValueObject\DueDate;
use Library\Circulation\Common\Infrastructure\DataFixtures\ReferenceFixture;
use Library\Circulation\Core\Book\Domain\Book;
use Library\Circulation\Core\Book\Domain\BookConstructorParameter;
use Library\Circulation\Core\LibraryMaterial\Domain\LibraryMaterialId;
use Library\Circulation\Core\Patron\Domain\Patron;
use Library\Circulation\Core\Patron\Domain\PatronId;

class BookMother extends Book
{
    public static function default(): LibraryMaterialId
    {
        return LibraryMaterialId::fromString(ReferenceFixture::$BOOK_ID);
    }

    public static function available(): Book
    {
        return new self(
            new BookConstructorParameter(false),
            LibraryCardMother::notBorrowed()
        );
    }

    public static function borrowedByNotDefaultPatron(): Book
    {
        return new self(
            new BookConstructorParameter(false),
            LibraryCardMother::borrowed(PatronMother::notDefault())
        );
    }

    public static function forInLibraryUseOnly(): Book
    {
        return new self(
            new BookConstructorParameter(true),
            LibraryCardMother::borrowed(PatronMother::default())
        );
    }

    public static function borrowedByDefaultPatron(): BookMother
    {
        return new self(
            new BookConstructorParameter(false),
            LibraryCardMother::borrowed(PatronMother::default())
        );
    }

    public static function borrowed(?PatronId $patronId = null, ?DueDate $dueDate = null): BookMother
    {
        $patronId = $patronId ?? PatronMother::default();

        return new self(
            new BookConstructorParameter(false),
            LibraryCardMother::borrowed($patronId, $dueDate)
        );
    }
}
