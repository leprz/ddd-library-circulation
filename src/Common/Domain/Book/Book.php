<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\Book;

use Library\Circulation\Common\Domain\LibraryCard\LibraryCard;
use Library\Circulation\Common\Domain\LibraryMaterial\LibraryMaterial;
use Library\Circulation\Common\Domain\ValueObject\DateTime;
use Library\Circulation\UseCase\BookCheckOut\Domain\BookCheckOutActionInterface;
use Library\Circulation\UseCase\BookCheckOut\Domain\BookCheckOutDataInterface;
use Library\Circulation\UseCase\BookCheckOut\Domain\BookCheckOutPolicy;

/**
 * @package Library\Circulation\Common\Domain\Book
 */
class Book extends LibraryMaterial
{
    protected function __construct(BookConstructorParameterInterface $data, LibraryCard $libraryCard)
    {
        $this->libraryCard = $libraryCard;
    }

    public static function register(LibraryCard $libraryCard): self
    {
        return new self(new BookConstructorParameter(), $libraryCard);
    }

    public function checkOut(
        BookCheckOutDataInterface $data,
        DateTime $checkOutAt,
        BookCheckOutActionInterface $action,
        BookCheckOutPolicy $policy
    ): LibraryCard {
        $policy->assertPatronHasReachedItemsLimit(
            $data->getBorrowerType(),
            $action->getAlreadyBorrowedBooksNumber(),
            $action->getAlreadyOverdueBooksNumber()
        );

        return $this->libraryCard->lend($data, $checkOutAt, $policy, $action);
    }
}
