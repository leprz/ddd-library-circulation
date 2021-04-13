<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\BookCheckOut\Infrastructure;

use Library\Circulation\Core\LibraryMaterial\Domain\LibraryMaterialId;
use Library\Circulation\Core\Patron\Domain\PatronIdentity;
use Library\Circulation\UseCase\BookCheckOut\Application\BookCheckOutCommand;
use Symfony\Component\Validator\Constraints as Assert;

class BookCheckOutContract
{
    #[Assert\Uuid]
    #[Assert\NotBlank]
    public ?string $libraryMaterialId = null;

    public function toCommand(PatronIdentity $identity): BookCheckOutCommand
    {
        return new BookCheckOutCommand(
            LibraryMaterialId::fromString($this->libraryMaterialId),
            $identity
        );
    }
}
