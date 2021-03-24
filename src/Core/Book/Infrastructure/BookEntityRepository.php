<?php

declare(strict_types=1);

namespace Library\Circulation\Core\Book\Infrastructure;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Library\Circulation\Core\Book\Application\BookRepositoryInterface;
use Library\Circulation\Core\Book\Domain\Book;
use Library\Circulation\Core\LibraryMaterial\Domain\LibraryMaterialId;
use Library\Circulation\Core\Patron\Domain\PatronId;
use Library\Circulation\Core\Satistics\Application\PatronBorrowStatisticsRepositoryInterface;
use Library\SharedKernel\Infrastructure\Persistence\QueryBuilderTrait;

/**
 * @package Library\Circulation\Core\Book\Infrastructure
 */
class BookEntityRepository implements BookRepositoryInterface, PatronBorrowStatisticsRepositoryInterface
{
    use QueryBuilderTrait;

    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    protected function getEntityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }

    /**
     * @return string
     */
    protected static function entityClass(): string
    {
        return BookEntity::class;
    }

    /**
     * @param \Library\Circulation\Core\LibraryMaterial\Domain\LibraryMaterialId $libraryCardId
     * @return \Library\Circulation\Core\Book\Domain\Book
     */
    public function getByLibraryCardId(LibraryMaterialId $libraryCardId): Book
    {
        try {
            $qb = $this->createQueryBuilder('book');

            $qb->select('book')
                ->where('book.id = :id')
                ->setParameters(
                    [
                        'id' => $libraryCardId,
                    ]
                );

            return new BookProxy(
                $qb->getQuery()->getSingleResult()
            );
        } catch (NoResultException $e) {
        } catch (NonUniqueResultException $e) {
            // TODO Convert Exception
        }
    }

    public function getByISBN(): Book
    {
        // TODO: Implement getByISBN() method.
    }

    public function countBorrowedBy(PatronId $patronId): int
    {
        // TODO: Implement countBorrowedBy() method.
        return 0;
    }

    public function countBorrowedOverdueBy(PatronId $patronId): int
    {
        // TODO: Implement countBorrowedOverdueBy() method.
        return 0;
    }
}
