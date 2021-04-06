<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Infrastructure\Persistence\Entity;

use Doctrine\ORM\Mapping as ORM;
use Library\Circulation\Core\LibraryCard\Infrastructure\LibraryCardEntity;

/**
 * @package Library\Circulation\Common\Infrastructure\Persistence\Entity
 * @ORM\Entity()
 */
class LibraryMaterialEntity extends LibraryCardEntity
{
    /**
     * @var bool
     * @ORM\Column(type="boolean", nullable=false)
     */
    protected bool $inLibraryUseOnly = false;

    public function setInLibraryUseOnly(bool $inLibraryUseOnly): void
    {
        $this->inLibraryUseOnly = $inLibraryUseOnly;
    }

    public function isForInLibraryUseOnly(): bool
    {
        return $this->inLibraryUseOnly;
    }
}
