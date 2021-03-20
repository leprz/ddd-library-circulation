<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Application\Persistence;

use Library\Circulation\Common\Domain\LibraryCard\LibraryCard;
use Library\Circulation\Common\Domain\LibraryMaterial\LibraryMaterialId;

/**
 * @package Library\Circulation\Common\Application\Persistence
 */
interface LibraryCardRepositoryInterface
{
    /**
     * @return \Library\Circulation\Common\Domain\LibraryCard\LibraryCard
     */
    public function getById(LibraryMaterialId $libraryCardId): LibraryCard;
}
