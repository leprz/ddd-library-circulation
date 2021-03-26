<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\OtherMaterialCheckOut\Domain;

use Library\Circulation\Common\Domain\ValueObject\DateTime;
use Library\Circulation\Common\Domain\ValueObject\DueDate;
use Library\Circulation\Core\OtherMaterial\Domain\Privilege\OtherMaterialPrivileges;
use Library\Circulation\Core\Patron\Domain\PatronType;
use Library\Circulation\UseCase\BookCheckOut\Domain\LibraryCardLoanPolicyInterface;

class OtherMaterialCheckOutPolicy implements LibraryCardLoanPolicyInterface
{
    public function __construct(
        private OtherMaterialPrivileges $materialPrivileges,
        private BusinessHoursServiceInterface $businessHoursService
    ) {
    }

    public function calculateLoanDueDate(DateTime $borrowedAt, PatronType $patronType): DueDate
    {
        $this->materialPrivileges->getLoanPeriod()->toDueDate(
            $borrowedAt,
            $this->businessHoursSerivice->getEndOfBusiness(
                $borrowedAt->asDate()
            )
        );
    }

    public function assertPatronDoNotViolateFinancialRules(float $balance): void
    {
        // TODO: Implement assertPatronDoNotViolateFinancialRules() method.
    }
}
