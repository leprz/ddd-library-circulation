<?php

declare(strict_types=1);

namespace Library\Circulation\Core\Book\Domain;

use Library\Circulation\Common\Domain\ValueObject\DateTime;
use Library\Circulation\Core\LibraryCard\Domain\LibraryCard;
use Library\Circulation\Core\LibraryMaterial\Domain\LibraryMaterial;
use Library\Circulation\UseCase\BookCheckOut\Domain\BookCheckOutActionInterface;
use Library\Circulation\UseCase\BookCheckOut\Domain\BookCheckOutDataInterface;
use Library\Circulation\UseCase\BookCheckOut\Domain\BookCheckOutPolicy;

/**
 * @package Library\Circulation\Core\Book\Domain
 */
class Book extends LibraryMaterial
{
    protected function __construct(BookConstructorParameterInterface $data, LibraryCard $libraryCard)
    {
        parent::__construct($data->isForInLibraryUseOnly(), $libraryCard);
    }

    public static function register(bool $isForInLibraryUseOnly, LibraryCard $libraryCard): self
    {
        return new self(new BookConstructorParameter($isForInLibraryUseOnly), $libraryCard);
    }

    /**
     * @param \Library\Circulation\UseCase\BookCheckOut\Domain\BookCheckOutDataInterface $data
     * @param \Library\Circulation\UseCase\BookCheckOut\Domain\BookCheckOutActionInterface $action
     * @param \Library\Circulation\UseCase\BookCheckOut\Domain\BookCheckOutPolicy $policy
     * @param \Library\Circulation\Common\Domain\ValueObject\DateTime $checkOutAt
     * @return \Library\Circulation\Core\LibraryCard\Domain\LibraryCard
     * @throws \Library\Circulation\Core\Book\Domain\Error\BorrowLimitExceededErrorException
     * @throws \Library\Circulation\Core\LibraryCard\Domain\Error\ItemAlreadyBorrowedErrorException
     * @throws \Library\Circulation\Core\LibraryMaterial\Domain\Error\LibraryMaterialBorrowErrorException
     */
    public function checkOut(
        BookCheckOutDataInterface $data,
        BookCheckOutActionInterface $action,
        BookCheckOutPolicy $policy,
        DateTime $checkOutAt,
    ): LibraryCard {
        return $this->lend(true, $data, $policy, $action, $checkOutAt);
    }
}