<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\Book;

/**
 * @package Library\Circulation\Common\Domain\Book
 */
class Book
{
    /**
     * @param \Library\Circulation\Common\Domain\Book\BookConstructorParameterInterface
     */
    public function __construct(BookConstructorParameterInterface $data)
    {
    }
}
