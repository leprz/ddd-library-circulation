<?php

declare(strict_types=1);

namespace Library\Circulation\Core\LibraryCard\Application;

use Library\Circulation\Core\LibraryCard\Domain\LibraryCard;
use Library\Circulation\Core\LibraryMaterial\Domain\LibraryMaterialId;

/**
 * @package Library\Circulation\Common\Application\Persistence
 */
interface LibraryCardRepositoryInterface
{
    /**
     * @return \Library\Circulation\Core\LibraryCard\Domain\LibraryCard
     */
    public function getById(LibraryMaterialId $libraryCardId): LibraryCard;
}
