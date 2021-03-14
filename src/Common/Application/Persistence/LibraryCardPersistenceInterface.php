<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Application\Persistence;

use Library\Circulation\Common\Domain\LibraryCard\LibraryCard;

/**
 * @package Library\Circulation\Common\Application\Persistence
 */
interface LibraryCardPersistenceInterface
{
    /**
     * @return void
     */
    public function flush(): void;

    /**
     * @param \Library\Circulation\Common\Domain\LibraryCard\LibraryCard
     * @return void
     */
    public function save(LibraryCard $model): void;

    /**
     * @param \Library\Circulation\Common\Domain\LibraryCard\LibraryCard
     * @return void
     */
    public function add(LibraryCard $model): void;
}
