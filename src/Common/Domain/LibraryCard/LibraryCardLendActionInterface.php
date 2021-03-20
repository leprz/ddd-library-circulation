<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\LibraryCard;

interface LibraryCardLendActionInterface
{
    public function getAccountBalance(): float;
}
