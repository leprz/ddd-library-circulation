<?php

declare(strict_types=1);

namespace Library\Circulation\Core\Book\Infrastructure;

use Doctrine\ORM\Mapping as ORM;
use Library\Circulation\Common\Infrastructure\Persistence\Entity\LibraryMaterialEntity;
use Library\Circulation\Core\Book\Domain\BookConstructorParameterInterface;
use Library\Circulation\Core\LibraryCard\Infrastructure\LibraryCardEntity;

/**
 * @ORM\Entity()
 * @ORM\Table(name="library_card__book")
 */
class BookEntity extends LibraryMaterialEntity implements BookConstructorParameterInterface
{
    public function getLibraryCard(): LibraryCardEntity
    {
        return $this;
    }
}