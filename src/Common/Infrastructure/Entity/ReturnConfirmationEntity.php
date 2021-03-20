<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Infrastructure\Entity;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping as ORM;
use Library\Circulation\Common\Domain\LibraryMaterial\LibraryMaterialId;
use Library\Circulation\Common\Domain\Patron\PatronId;
use Library\Circulation\Common\Domain\ReturnConfirmation\ReturnConfirmationConstructorParameterInterface;
use Library\Circulation\Common\Domain\ReturnConfirmation\ReturnConfirmationId;
use Library\Circulation\Common\Domain\ValueObject\DateTime;
use Library\Circulation\Common\Domain\ValueObject\DueDate;

/**
 * @package Library\Circulation\Common\Infrastructure\Entity
 * @ORM\Entity()
 * @ORM\Table(name="patron_return_confirmation")
 */
class ReturnConfirmationEntity implements ReturnConfirmationConstructorParameterInterface
{
    /**
     * @var string
     * @ORM\Id()
     * @ORM\Column(type="guid")
     */
    private string $id;

    /**
     * @var \Library\Circulation\Common\Infrastructure\Entity\LibraryCardEntity
     * @ORM\ManyToOne(targetEntity="Library\Circulation\Common\Infrastructure\Entity\LibraryCardEntity")
     */
    private LibraryCardEntity $libraryCard;

    /**
     * @var \Library\Circulation\Common\Infrastructure\Entity\PatronEntity
     * @ORM\ManyToOne(targetEntity="Library\Circulation\Common\Infrastructure\Entity\PatronEntity")
     */
    private PatronEntity $borrower;

    /**
     * @var \Library\Circulation\Common\Domain\ValueObject\DateTime
     * @ORM\Column(type="datetime", nullable=false)
     */
    private DateTime $scheduledReturnDate;

    /**
     * @var \Library\Circulation\Common\Domain\ValueObject\DateTime
     * @ORM\Column(type="datetime", nullable=false)
     */
    private DateTime $returnedAt;

    /**
     * @param \Library\Circulation\Common\Domain\ReturnConfirmation\ReturnConfirmationId $id
     */
    public function setId(ReturnConfirmationId $id): void
    {
        $this->id = (string)$id;
    }

    public function setMaterialId(LibraryMaterialId $materialId, EntityManagerInterface $entityManager): void {
        /** @noinspection PhpFieldAssignmentTypeMismatchInspection */
        $this->libraryCard = $entityManager->getReference(LibraryCardEntity::class, (string)$materialId);
    }

    /**
     * @param \Library\Circulation\Common\Infrastructure\Entity\LibraryCardEntity $libraryCard
     */
    public function setLibraryCard(LibraryCardEntity $libraryCard): void
    {
        $this->libraryCard = $libraryCard;
    }

    /**
     * @param \Library\Circulation\Common\Domain\Patron\PatronId $borrowerId
     * @param \Doctrine\ORM\EntityManagerInterface $entityManager
     * @throws \Doctrine\ORM\ORMException
     */
    public function setBorrowerId(PatronId $borrowerId, EntityManagerInterface $entityManager): void
    {
        $this->borrower = $entityManager->getReference(PatronEntity::class, (string)$borrowerId);
    }

    /**
     * @param \Library\Circulation\Common\Domain\ValueObject\DueDate $scheduledReturnDate
     */
    public function setScheduledReturnDate(DueDate $scheduledReturnDate): void
    {
        $this->scheduledReturnDate = $scheduledReturnDate->toDateTime();
    }

    /**
     * @param \Library\Circulation\Common\Domain\ValueObject\DateTime $returnedAt
     */
    public function setReturnedAt(DateTime $returnedAt): void
    {
        $this->returnedAt = $returnedAt;
    }

    public function getReturnConfirmationId(): ReturnConfirmationId
    {
        return ReturnConfirmationId::fromString($this->id);
    }

    public function getMaterialId(): LibraryMaterialId
    {
        return $this->libraryCard->getId();
    }

    public function getBorrowerId(): PatronId
    {
        return $this->borrower->getId();
    }

    public function getScheduledReturnDate(): DueDate
    {
        return new DueDate($this->scheduledReturnDate);
    }

    public function getReturnedAt(): DateTime
    {
        return $this->returnedAt;
    }
}