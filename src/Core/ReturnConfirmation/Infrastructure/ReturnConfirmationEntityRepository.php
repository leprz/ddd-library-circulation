<?php

declare(strict_types=1);

namespace Library\Circulation\Core\ReturnConfirmation\Infrastructure;

use Doctrine\ORM\EntityManagerInterface;
use Library\Circulation\Core\LibraryMaterial\Domain\LibraryMaterialId;
use Library\Circulation\Core\Patron\Domain\PatronId;
use Library\Circulation\Core\ReturnConfirmation\Application\ReturnConfirmationRepositoryInterface;
use Library\Circulation\Core\ReturnConfirmation\Domain\ReturnConfirmation;
use Library\Circulation\Core\ReturnConfirmation\Domain\ReturnConfirmationId;
use Library\SharedKernel\Infrastructure\Persistence\QueryBuilderTrait;

/**
 * @package Library\Circulation\Core\ReturnConfirmation\Infrastructure
 */
class ReturnConfirmationEntityRepository implements ReturnConfirmationRepositoryInterface
{
    use QueryBuilderTrait;

    /**
     * @return string
     */
    protected static function entityClass(): string
    {
        return ReturnConfirmationEntity::class;
    }

    /**
     * @return \Library\Circulation\Core\ReturnConfirmation\Domain\ReturnConfirmation
     */
    public function getById(): ReturnConfirmation
    {
    }

    /**
     * @param \Doctrine\ORM\EntityManagerInterface
     */
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    /**
     * @return \Doctrine\ORM\EntityManagerInterface
     */
    protected function getEntityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }

    public function getLastReturnConfirmation(LibraryMaterialId $id, PatronId $borrowerId): ReturnConfirmation
    {
        $qb = $this->createQueryBuilder('return_confirmation');

        $qb->where(
            'return_confirmation.libraryCard = :materialId AND return_confirmation.borrower = :borrowerId'
        );

        $qb->setParameters(
            [
                'materialId' => (string)$id,
                'borrowerId' => (string)$borrowerId
            ]
        );

        return new ReturnConfirmationProxy($qb->getQuery()->getSingleResult());
    }

    public function exists(ReturnConfirmationId $id): bool
    {
        $qb = $this->createQueryBuilder('return_confirmation');
        $qb->where('return_confirmation.id = :id');
        $qb->setParameter('id', (string)$id);
        return null !== $qb->getQuery()->getOneOrNullResult();
    }
}
