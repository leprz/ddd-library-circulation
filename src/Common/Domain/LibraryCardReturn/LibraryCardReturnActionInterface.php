<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\LibraryCardReturn;

use Library\Circulation\Common\Domain\DomainEvent\DomainBroadcastEvent;
use Library\Circulation\Core\LibraryCard\Domain\LibraryCard;
use Library\Circulation\Core\LibraryMaterial\Domain\LibraryMaterialId;
use Library\Circulation\Core\Patron\Domain\PatronId;
use Library\Circulation\Core\ReturnConfirmation\Domain\ReturnConfirmation;
use Library\Circulation\Core\ReturnConfirmation\Domain\ReturnConfirmationId;

/**
 * @package Library\Circulation\Common\Domain\LibraryMaterialReturn
 */
interface LibraryCardReturnActionInterface
{
    public function generateNextReturnConfirmationId(): ReturnConfirmationId;

    public function getLastReturnConfirmation(
        LibraryMaterialId $id,
        PatronId $borrowerId
    ): ReturnConfirmation;

    public function saveLibraryCard(LibraryCard $libraryCard): void;

    public function dispatchGlobalEvent(object $event, object $emitter): void;

    public function dispatchInternalEvent(object $event);
}
