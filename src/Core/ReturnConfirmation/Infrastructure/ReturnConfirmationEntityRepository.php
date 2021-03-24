<?php

declare(strict_types=1);

namespace Library\Circulation\Core\ReturnConfirmation\Infrastructure;

use Doctrine\ORM\EntityManagerInterface;
use Library\Circulation\Core\ReturnConfirmation\Application\ReturnConfirmationRepositoryInterface;
use Library\Circulation\Core\ReturnConfirmation\Domain\ReturnConfirmation;
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
    public function __construct(EntityManagerInterface $entityManager)
    {
    }

    /**
     * @return \Doctrine\ORM\EntityManagerInterface
     */
    protected function getEntityManager(): EntityManagerInterface
    {
    }
}
