<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Application\Persistence;

use Library\Circulation\Common\Domain\LibraryCard\LibraryCard;

/**
 * @package Library\Circulation\Common\Application\Persistence
 */
interface LibraryCardRepositoryInterface
{
    /**
     * @return \Library\Circulation\Common\Domain\LibraryCard\LibraryCard
     */
    public function getById(): LibraryCard;
}
