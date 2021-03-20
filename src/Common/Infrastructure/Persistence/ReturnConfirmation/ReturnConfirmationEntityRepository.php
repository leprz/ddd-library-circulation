<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Infrastructure\Persistence\ReturnConfirmation;

use Doctrine\ORM\EntityManagerInterface;
use Library\Circulation\Common\Application\Persistence\ReturnConfirmation\ReturnConfirmationRepositoryInterface;
use Library\Circulation\Common\Domain\ReturnConfirmation\ReturnConfirmation;
use Library\SharedKernel\Infrastructure\Persistence\QueryBuilderTrait;

/**
 * @package Library\Circulation\Common\Infrastructure\Persistence\ReturnConfirmation
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
     * @return \Library\Circulation\Common\Domain\ReturnConfirmation\ReturnConfirmation
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
