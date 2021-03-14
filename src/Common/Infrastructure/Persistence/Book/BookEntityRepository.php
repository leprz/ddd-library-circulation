<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Infrastructure\Persistence\Book;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Library\Circulation\Common\Application\Persistence\BookRepositoryInterface;
use Library\Circulation\Common\Domain\Book\Book;
use Library\Circulation\Common\Domain\LibraryCard\LibraryCardId;
use Library\Circulation\Common\Infrastructure\Entity\BookEntity;
use Library\SharedKernel\Infrastructure\Persistence\QueryBuilderTrait;

/**
 * @package Library\Circulation\Common\Infrastructure\Persistence\Book
 */
class BookEntityRepository implements BookRepositoryInterface
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
     * @param \Library\Circulation\Common\Domain\LibraryCard\LibraryCardId $libraryCardId
     * @return \Library\Circulation\Common\Domain\Book\Book
     */
    public function getByLibraryCardId(LibraryCardId $libraryCardId): Book
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
}
