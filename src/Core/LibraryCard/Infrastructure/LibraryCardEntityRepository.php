<?php

declare(strict_types=1);

namespace Library\Circulation\Core\LibraryCard\Infrastructure;

use Doctrine\ORM\EntityManagerInterface;
use Library\Circulation\Core\LibraryCard\Application\LibraryCardRepositoryInterface;
use Library\Circulation\Core\LibraryCard\Domain\LibraryCard;
use Library\Circulation\Core\LibraryMaterial\Domain\LibraryMaterialId;
use Library\SharedKernel\Infrastructure\Persistence\QueryBuilderTrait;

/**
 * @package Library\Circulation\Core\LibraryCard\Infrastructure
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
     * @param \Library\Circulation\Core\LibraryMaterial\Domain\LibraryMaterialId $libraryCardId
     * @return \Library\Circulation\Core\LibraryCard\Domain\LibraryCard
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
