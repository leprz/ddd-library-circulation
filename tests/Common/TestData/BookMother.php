<?php

declare(strict_types=1);

namespace Library\Circulation\Tests\Common\TestData;

use Library\Circulation\Common\Infrastructure\DataFixtures\ReferenceFixture;
use Library\Circulation\Core\Book\Domain\Book;
use Library\Circulation\Core\Book\Domain\BookConstructorParameter;
use Library\Circulation\Core\LibraryMaterial\Domain\LibraryMaterialId;

class BookMother extends Book
{
    public static function default(): LibraryMaterialId
    {
        return LibraryMaterialId::fromString(ReferenceFixture::$BOOK_ID);
    }

    public static function available(): self
    {
        return new self(
            new BookConstructorParameter(),
            LibraryCardMother::notBorrowed()
        );
    }

    public static function borrowedByNotDefaultPatron(): self
    {
        return new self(
            new BookConstructorParameter(),
            LibraryCardMother::borrowed(PatronMother::notDefault())
        );
    }
}
