<?php

declare(strict_types=1);

namespace Library\Circulation\Core\LibraryCard\Infrastructure;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping as ORM;
use Library\Circulation\Common\Domain\ValueObject\DateTime;
use Library\Circulation\Common\Domain\ValueObject\DueDate;
use Library\Circulation\Core\LibraryCard\Domain\LibraryCardConstructorParameterInterface;
use Library\Circulation\Core\LibraryMaterial\Domain\LibraryMaterialId;
use Library\Circulation\Core\Patron\Domain\PatronId;
use Library\Circulation\Core\Patron\Infrastructure\PatronEntity;

/**
 * @ORM\Entity()
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"book" = "Library\Circulation\Core\Book\Infrastructure\BookEntity"})
 * @ORM\Table(name="library_card")
 */
abstract class LibraryCardEntity implements LibraryCardConstructorParameterInterface
{
    /**
     * @var string
     * @ORM\Id()
     * @ORM\Column(type="guid")
     */
    protected string $id;

    /**
     * @var \Library\Circulation\Core\Patron\Infrastructure\PatronEntity|null
     * @ORM\ManyToOne(targetEntity="Library\Circulation\Core\Patron\Infrastructure\PatronEntity")
     */
    private ?PatronEntity $borrower = null;

    /**
     * @var \Library\Circulation\Common\Domain\ValueObject\DateTime|null
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?DateTime $dueDate = null;

    public function __construct(LibraryMaterialId $id)
    {
        $this->id = (string)$id;
    }


    public function libraryMaterialId(): LibraryMaterialId
    {
        return LibraryMaterialId::fromString($this->id);
    }

    public function setMaterialId(LibraryMaterialId $materialId): void
    {
        $this->id = (string)$materialId;
    }

    public function getBorrowerId(): ?PatronId
    {
        if ($this->borrower) {
            return $this->borrower->getId();
        }

        return null;
    }

    public function getDueDate(): ?DueDate
    {
        if ($this->dueDate !== null) {
            return new DueDate($this->dueDate);
        }

        return null;
    }

    public function setId(LibraryMaterialId $libraryCardId): void
    {
        $this->id = (string)$libraryCardId;
    }

    public function setBorrowerId(?PatronId $borrowerId, EntityManagerInterface $entityManager): void
    {
        if ($borrowerId !== null) {
            $this->borrower = $entityManager->getReference(PatronEntity::class, (string)$borrowerId);
        } else {
            $this->borrower = null;
        }
    }

    public function setDueDate(?DueDate $dueDate): void
    {
        if ($dueDate !== null) {
            $this->dueDate = $dueDate->toDateTime();
        } else {
            $this->dueDate = null;
        }
    }

    public function getId(): LibraryMaterialId
    {
        return LibraryMaterialId::fromString($this->id);
    }

    public function setBorrower(PatronEntity $borrower): void
    {
        $this->borrower = $borrower;
    }
}
