<?php

declare(strict_types=1);

namespace Library\Circulation\Core\Satistics\Application;

use Library\Circulation\Core\Patron\Domain\PatronId;

interface PatronBorrowStatisticsRepositoryInterface
{
    public function countBorrowedBy(PatronId $patronId): int;

    public function countBorrowedOverdueBy(PatronId $patronId): int;
}
