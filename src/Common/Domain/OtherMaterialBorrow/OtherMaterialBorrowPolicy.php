<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\OtherMaterialBorrow;

use Library\Circulation\Common\Domain\CheckOut\CheckOutPolicy;
use Library\Circulation\Common\Domain\ValueObject\DateTime;
use Library\Circulation\Common\Domain\ValueObject\DueDate;
use Library\Circulation\Core\Book\Domain\Error\ItemsLimitExceededErrorException;
use Library\Circulation\Core\BusinessHours\Domain\BusinessHoursServiceInterface;
use Library\Circulation\Core\OtherMaterial\Domain\Privilege\OtherMaterialPrivileges;
use Library\Circulation\Core\Patron\Domain\PatronType;

class OtherMaterialBorrowPolicy extends CheckOutPolicy
{
    public function __construct(
        private OtherMaterialPrivileges $materialPrivileges,
        protected BusinessHoursServiceInterface $businessHoursService
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
        if ($alreadyBorrowedItemsNumber >= $this->materialPrivileges->getItemsLimit()) {
            throw ItemsLimitExceededErrorException::forNotOverdue();
        }

        if ($alreadyOverdueItemsNumber >= $this->materialPrivileges->getOverdueItemsLimit()) {
            throw ItemsLimitExceededErrorException::forOverdue();
        }
    }
}
