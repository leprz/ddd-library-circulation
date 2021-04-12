<?php

declare(strict_types=1);

namespace Library\Circulation\Core\Book\Infrastructure;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Library\Circulation\Common\Application\Exception\EntityNotFoundException;
use Library\Circulation\Common\Application\Exception\NotFoundException;
use Library\Circulation\Core\Book\Application\BookRepositoryInterface;
use Library\Circulation\Core\Book\Domain\Book;
use Library\Circulation\Core\LibraryMaterial\Domain\LibraryMaterialId;
use Library\Circulation\Core\Patron\Domain\PatronId;
use Library\Circulation\Core\Satistics\Application\PatronBorrowedBooksStatisticsRepositoryInterface;
use Library\SharedKernel\Infrastructure\Persistence\QueryBuilderTrait;
use LogicException;

/**
 * @package Library\Circulation\Core\Book\Infrastructure
 */
class BookEntityRepository implements BookRepositoryInterface, PatronBorrowedBooksStatisticsRepositoryInterface
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
     * @inheritdoc
     */
    public function getByLibraryMaterialId(LibraryMaterialId $libraryCardId): Book
    {
        $qb = $this->createQueryBuilder('book');

        $qb->select('book')
            ->where('book.id = :id')
            ->setParameters(
                [
                    'id' => $libraryCardId,
                ]
            );
        return new BookProxy(
            $this->getSingleResult((string) $libraryCardId, $qb)
        );
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
