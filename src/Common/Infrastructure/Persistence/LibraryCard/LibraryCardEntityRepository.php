<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Infrastructure\Persistence\LibraryCard;

use Doctrine\ORM\EntityManagerInterface;
use Library\Circulation\Common\Application\Persistence\LibraryCardRepositoryInterface;
use Library\Circulation\Common\Domain\LibraryCard\LibraryCard;
use Library\Circulation\Common\Domain\LibraryMaterial\LibraryMaterialId;
use Library\Circulation\Common\Infrastructure\Entity\LibraryCardEntity;
use Library\SharedKernel\Infrastructure\Persistence\QueryBuilderTrait;

/**
 * @package Library\Circulation\Common\Infrastructure\Persistence\LibraryCard
 */
class LibraryCardEntityRepository implements LibraryCardRepositoryInterface
{
    use QueryBuilderTrait;

    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    /**
     * @return string
     */
    protected static function entityClass(): string
    {
        return LibraryCardEntity::class;
    }

    protected function getEntityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }

    /**
     * @param \Library\Circulation\Common\Domain\LibraryMaterial\LibraryMaterialId $libraryCardId
     * @return \Library\Circulation\Common\Domain\LibraryCard\LibraryCard
     */
    public function getById(LibraryMaterialId $libraryCardId): LibraryCard
    {
        $qb = $this->createQueryBuilder('libraryCard');
        $qb->select('libraryCard');
        $qb->where('libraryCard.id = :id');
        $qb->setParameters(
            [
                'id' => (string) $libraryCardId
            ]
        );

        return new LibraryCardProxy($qb->getQuery()->getSingleResult());
    }
}
