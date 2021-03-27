<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\OtherMaterialCheckOut\Domain;

use Library\Circulation\Common\Domain\CheckOut\CheckOutPolicy;
use Library\Circulation\Common\Domain\ValueObject\DateTime;
use Library\Circulation\Common\Domain\ValueObject\DueDate;
use Library\Circulation\Core\BusinessHours\Application\BusinessHoursServiceInterface;
use Library\Circulation\Core\OtherMaterial\Domain\Privilege\OtherMaterialPrivileges;
use Library\Circulation\Core\Patron\Domain\PatronType;

class OtherMaterialCheckOutPolicy extends CheckOutPolicy
{
    public function __construct(
        private OtherMaterialPrivileges $materialPrivileges,
        private BusinessHoursServiceInterface $businessHoursService
    ) {
    }

    public function calculateLoanDueDate(DateTime $borrowedAt, PatronType $patronType): DueDate
    {
        return $this->materialPrivileges->getLoanPeriod()->toDueDate(
            $borrowedAt,
            $this->businessHoursService->getEndOfBusinessFor(
                $borrowedAt->asDate()
            )
        );
    }

    public function assertPatronHasReachedItemsLimit(
        PatronType $patronType,
        int $alreadyBorrowedItemsNumber,
        int $alreadyOverdueItemsNumber
    ): void {
        if ($alreadyBorrowedItemsNumber === $this->materialPrivileges->get || $alreadyOverdueItemsNumber === 1) {

        }
    }
}
