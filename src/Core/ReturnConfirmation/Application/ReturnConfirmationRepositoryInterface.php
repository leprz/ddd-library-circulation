<?php

declare(strict_types=1);

namespace Library\Circulation\Core\ReturnConfirmation\Application;

use Library\Circulation\Core\LibraryMaterial\Domain\LibraryMaterialId;
use Library\Circulation\Core\Patron\Domain\PatronId;
use Library\Circulation\Core\ReturnConfirmation\Domain\ReturnConfirmation;
use Library\Circulation\Core\ReturnConfirmation\Domain\ReturnConfirmationId;

/**
 * @package Library\Circulation\Common\Application\Persistence\ReturnConfirmation
 */
interface ReturnConfirmationRepositoryInterface
{
    /**
     * @return \Library\Circulation\Core\ReturnConfirmation\Domain\ReturnConfirmation
     */
    public function getById(): ReturnConfirmation;

    public function getLastReturnConfirmation(LibraryMaterialId $id, PatronId $borrowerId): ReturnConfirmation;

    public function exists(ReturnConfirmationId $id): bool;
}
