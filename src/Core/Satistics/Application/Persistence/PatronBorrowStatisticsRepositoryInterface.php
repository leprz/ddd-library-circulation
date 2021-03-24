<?php

declare(strict_types=1);

namespace Library\Circulation\Core\Satistics\Application\Persistence;

use Library\Circulation\Common\Domain\Patron\PatronId;

interface PatronBorrowStatisticsRepositoryInterface
{
    public function countBorrowedBy(PatronId $patronId): int;

    public function countBorrowedOverdueBy(PatronId $patronId): int;
}
