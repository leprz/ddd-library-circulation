<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Application\Persistence;

use Library\Circulation\Common\Domain\Book\Book;

/**
 * @package Library\Circulation\Common\Application\Persistence
 */
interface BookRepositoryInterface
{
    /**
     * @return \Library\Circulation\Common\Domain\Book\Book
     */
    public function getById(): Book;
}
