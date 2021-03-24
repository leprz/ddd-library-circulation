<?php

declare(strict_types=1);

namespace Library\Circulation\Core\LibraryCard\Application;

use Library\Circulation\Core\LibraryCard\Domain\LibraryCard;

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
     * @param \Library\Circulation\Core\LibraryCard\Domain\LibraryCard
     * @return void
     */
    public function save(LibraryCard $model): void;

    /**
     * @param \Library\Circulation\Core\LibraryCard\Domain\LibraryCard
     * @return void
     */
    public function add(LibraryCard $model): void;
}
