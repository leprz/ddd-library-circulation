<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\LibraryCardReturn;

use Library\Circulation\Common\Domain\ValueObject\TimePeriod;
use Library\Circulation\Core\LibraryMaterial\Domain\LibraryMaterialId;
use Library\Circulation\Core\Patron\Domain\PatronId;

class LibraryCardReturnedEvent
{
    public function __construct(
        private PatronId $borrowerId,
        private LibraryMaterialId $materialId,
        private TimePeriod $overDueTimePeriod
    ) {
    }

    /**
     * @return \Library\Circulation\Core\Patron\Domain\PatronId
     */
    public function getBorrowerId(): PatronId
    {
        return $this->borrowerId;
    }

    /**
     * @return \Library\Circulation\Core\LibraryMaterial\Domain\LibraryMaterialId
     */
    public function getMaterialId(): LibraryMaterialId
    {
        return $this->materialId;
    }

    /**
     * @return \Library\Circulation\Common\Domain\ValueObject\TimePeriod
     */
    public function getOverDueTimePeriod(): TimePeriod
    {
        return $this->overDueTimePeriod;
    }

    public function hasMaterialBeenReturnedOverDue(): bool
    {
        return $this->overDueTimePeriod->isNotEmpty();
    }

    public function hasBeenDispatchedFor(LibraryMaterialId $materialId): bool
    {
        return $this->materialId->equals($materialId);
    }
}
