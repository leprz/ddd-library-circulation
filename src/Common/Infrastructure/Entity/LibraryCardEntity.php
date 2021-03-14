<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Infrastructure\Entity;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping as ORM;
use Library\Circulation\Common\Domain\LibraryCard\LibraryCardConstructorParameterInterface;
use Library\Circulation\Common\Domain\LibraryCard\LibraryCardId;
use Library\Circulation\Common\Domain\Patron\PatronId;
use Library\Circulation\Common\Domain\ValueObject\Date;
use Library\Circulation\Common\Domain\ValueObject\DueDate;

/**
 * @ORM\Entity()
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"book" = "BookEntity"})
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
     * @var \Library\Circulation\Common\Infrastructure\Entity\PatronEntity|null
     * @ORM\ManyToOne(targetEntity="Library\Circulation\Common\Infrastructure\Entity\PatronEntity")
     */
    private ?PatronEntity $borrower = null;

    /**
     * @var \Library\Circulation\Common\Domain\ValueObject\Date|null
     * @ORM\Column(type="date", nullable=true)
     */
    private ?Date $dueDate = null;

    public function __construct(LibraryCardId $id)
    {
        $this->id = (string)$id;
    }


    public function libraryCardId(): LibraryCardId
    {
        return LibraryCardId::fromString($this->id);
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

    public function setLibraryCardId(LibraryCardId $libraryCardId): void
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
            $this->dueDate = $dueDate->toDate();
        } else {
            $this->dueDate = null;
        }
    }
}
