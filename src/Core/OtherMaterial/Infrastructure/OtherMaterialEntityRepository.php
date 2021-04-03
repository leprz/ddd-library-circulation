<?php

declare(strict_types=1);

namespace Library\Circulation\Core\OtherMaterial\Infrastructure;

use Doctrine\ORM\EntityManagerInterface;
use Library\Circulation\Core\LibraryMaterial\Domain\LibraryMaterialId;
use Library\Circulation\Core\OtherMaterial\Application\OtherMaterialRepositoryInterface;
use Library\Circulation\Core\OtherMaterial\Domain\OtherMaterial;
use Library\Circulation\Core\OtherMaterial\Domain\OtherMaterialType;
use Library\Circulation\Core\Patron\Domain\PatronId;
use Library\Circulation\Core\Satistics\Application\PatronBorrowedOtherMaterialsStatisticsRepositoryInterface;
use Library\SharedKernel\Infrastructure\Persistence\QueryBuilderTrait;

/**
 * @package Library\Circulation\Core\OtherMaterial\Infrastructure
 */
class OtherMaterialEntityRepository implements OtherMaterialRepositoryInterface,
                                               PatronBorrowedOtherMaterialsStatisticsRepositoryInterface
{
    use QueryBuilderTrait;

    /**
     * @return string
     */
    protected static function entityClass(): string
    {
    }

    /**
     * @inheridoc;
     */
    public function getById(LibraryMaterialId $materialId): OtherMaterial
    {
    }

    /**
     * @param \Doctrine\ORM\EntityManagerInterface
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
    }

    /**
     * @return \Doctrine\ORM\EntityManagerInterface
     */
    protected function getEntityManager(): EntityManagerInterface
    {
    }

    public function countBorrowedBy(PatronId $patronId, OtherMaterialType $materialType): int
    {
        return 0;
        // TODO: Implement countBorrowedBy() method.
    }

    public function countBorrowedOverdueBy(PatronId $patronId, OtherMaterialType $materialType): int
    {
        return 0;
        // TODO: Implement countBorrowedOverdueBy() method.
    }
}
