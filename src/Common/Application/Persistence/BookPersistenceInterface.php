<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Application\Persistence;

use Library\Circulation\Common\Domain\Book\Book;

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
     * @param \Library\Circulation\Common\Domain\Book\Book
     * @return void
     */
    public function save(Book $model): void;

    /**
     * @param \Library\Circulation\Common\Domain\Book\Book
     * @return void
     */
    public function add(Book $model): void;
}
