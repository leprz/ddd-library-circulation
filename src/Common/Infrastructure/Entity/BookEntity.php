<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Infrastructure\Entity;

use Doctrine\ORM\Mapping as ORM;
use Library\Circulation\Common\Domain\Book\BookConstructorParameterInterface;
use Library\Circulation\Common\Domain\LibraryCard\LibraryCardConstructorParameterInterface;

/**
 * @ORM\Entity()
 * @ORM\Table(name="library_card__book")
 */
class BookEntity extends LibraryCardEntity implements BookConstructorParameterInterface
{
    public function getLibraryCard(): LibraryCardEntity
    {
        return $this;
    }
}
