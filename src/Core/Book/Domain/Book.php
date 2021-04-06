<?php

declare(strict_types=1);

namespace Library\Circulation\Core\Book\Domain;

use Library\Circulation\Common\Domain\LibraryCardReturn\LibraryCardReturnedEvent;
use Library\Circulation\Common\Domain\ValueObject\DateTime;
use Library\Circulation\Core\LibraryCard\Domain\LibraryCard;
use Library\Circulation\Core\LibraryMaterial\Domain\LibraryMaterial;
use Library\Circulation\Core\ReturnConfirmation\Domain\ReturnConfirmation;
use Library\Circulation\UseCase\BookCheckIn\Domain\BookCheckInActionInterface;
use Library\Circulation\UseCase\BookCheckIn\Domain\BookCheckInDataInterface;
use Library\Circulation\UseCase\BookCheckOut\Domain\BookCheckOutActionInterface;
use Library\Circulation\UseCase\BookCheckOut\Domain\BookCheckOutDataInterface;
use Library\Circulation\UseCase\BookCheckOut\Domain\BookCheckOutPolicy;
use Library\SharedKernel\Domain\Event\Circulation\BookCheckedInOverDueEvent;

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
     * @throws \Library\Circulation\Core\Book\Domain\Error\ItemsLimitExceededErrorException
     * @throws \Library\Circulation\Core\LibraryCard\Domain\Error\LibraryMaterialAlreadyBorrowedErrorException
     * @throws \Library\Circulation\Core\LibraryMaterial\Domain\Error\LibraryMaterialNotForCheckOutErrorException
     * @throws \Library\Circulation\Core\LibraryCard\Domain\Error\FinancialRulesViolationErrorException
     */
    public function checkOut(
        BookCheckOutDataInterface $data,
        BookCheckOutActionInterface $action,
        BookCheckOutPolicy $policy,
        DateTime $checkOutAt,
    ): LibraryCard {
        $this->assertCanBeUsedOutsideLibrary();

        return $this->lendLibraryCard($data, $policy, $action, $checkOutAt);
    }

    /**
     * @param \Library\Circulation\UseCase\BookCheckIn\Domain\BookCheckInDataInterface $data
     * @param \Library\Circulation\UseCase\BookCheckIn\Domain\BookCheckInActionInterface $action
     * @return \Library\Circulation\Core\ReturnConfirmation\Domain\ReturnConfirmation
     */
    public function checkIn(
        BookCheckInDataInterface $data,
        BookCheckInActionInterface $action
    ): ReturnConfirmation {
        $action->subscribeEvent(
            LibraryCardReturnedEvent::class,
            $this->handleOverDueCheckIn($action, $data)
        );

        return $this->returnLibraryCard($data, $action);
    }

    private function handleOverDueCheckIn(BookCheckInActionInterface $action, BookCheckInDataInterface $data): callable
    {
        return function (LibraryCardReturnedEvent $event) use ($action, $data): void {
            if ($event->hasMaterialBeenReturnedOverDue() &&
                $event->hasBeenDispatchedFor($data->getLibraryMaterialId())
            ) {
                $action->dispatchGlobalEvent(
                    new BookCheckedInOverDueEvent(
                        (string)$event->getBorrowerId(),
                        (string)$event->getMaterialId(),
                        (string)$event->getOverDueTimePeriod(),
                    ),
                    Book::class
                );
            }
        };
    }
}
