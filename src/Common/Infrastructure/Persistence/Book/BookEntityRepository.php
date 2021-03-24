<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Infrastructure\Persistence\Book;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Library\Circulation\Common\Application\Persistence\BookRepositoryInterface;
use Library\Circulation\Common\Domain\Book\Book;
use Library\Circulation\Common\Domain\LibraryMaterial\LibraryMaterialId;
use Library\Circulation\Common\Domain\Patron\PatronId;
use Library\Circulation\Common\Infrastructure\Entity\BookEntity;
use Library\Circulation\Core\Satistics\Application\Persistence\PatronBorrowStatisticsRepositoryInterface;
use Library\SharedKernel\Infrastructure\Persistence\QueryBuilderTrait;

/**
 * @package Library\Circulation\Common\Infrastructure\Persistence\Book
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
     * @param \Library\Circulation\Common\Domain\LibraryMaterial\LibraryMaterialId $libraryCardId
     * @return \Library\Circulation\Common\Domain\Book\Book
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
