<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\OtherMaterialUseInLibrary\Domain;

use Library\Circulation\Common\Domain\OtherMaterialBorrow\OtherMaterialBorrowPolicy;
use Library\Circulation\Common\Domain\ValueObject\DateTime;
use Library\Circulation\Common\Domain\ValueObject\DueDate;
use Library\Circulation\Core\Patron\Domain\PatronType;

class OtherMaterialInLibraryUsePolicy extends OtherMaterialBorrowPolicy
{
    public function calculateLoanDueDate(DateTime $borrowedAt, PatronType $patronType): DueDate
    {
        $businessClosingTime = $this->businessHoursService->getEndOfBusinessFor($borrowedAt->asDate());
        $dueDate = parent::calculateLoanDueDate($borrowedAt, $patronType);

        if (!$dueDate->isBefore($businessClosingTime)) {
            return new DueDate($businessClosingTime);
        }

        return $dueDate;
    }
}
