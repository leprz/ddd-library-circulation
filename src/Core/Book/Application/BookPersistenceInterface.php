<?php

declare(strict_types=1);

namespace Library\Circulation\Core\Book\Application;

use Library\Circulation\Core\Book\Domain\Book;

/**
 * @package Library\Circulation\Common\Application\Persistence
 */
interface BookPersistenceInterface
{
    /**
     * @return void
     */
    public function flush(): void;

    /**
     * @param \Library\Circulation\Core\Book\Domain\Book
     * @return void
     */
    public function save(Book $model): void;

    /**
     * @param \Library\Circulation\Core\Book\Domain\Book
     * @return void
     */
    public function add(Book $model): void;
}
