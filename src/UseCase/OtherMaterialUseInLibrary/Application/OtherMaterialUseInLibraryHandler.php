<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\OtherMaterialUseInLibrary\Application;

use Library\Circulation\Common\Application\Date\ClockInterface;
use Library\Circulation\Common\Domain\OtherMaterialBorrow\OtherMaterialBorrowPolicyBuilder;
use Library\Circulation\Core\OtherMaterial\Application\OtherMaterialRepositoryInterface;
use Library\Circulation\UseCase\OtherMaterialUseInLibrary\Domain\OtherMaterialUseInLibraryActionBuilderInterface;

/**
 * @package Library\Circulation\UseCase\OtherMaterialUseInLibrary\Application
 */
class OtherMaterialUseInLibraryHandler
{
    public function __construct(
        private OtherMaterialRepositoryInterface $otherMaterialRepository,
        private OtherMaterialUseInLibraryActionBuilderInterface $actionBuilder,
        private OtherMaterialBorrowPolicyBuilder $policyBuilder,
        private ClockInterface $clock,
    ) {
    }

    /**
     * @param \Library\Circulation\UseCase\OtherMaterialUseInLibrary\Application\OtherMaterialUseInLibraryCommand
     * @return void
     * @throws \ErrorException
     */
    public function __invoke(OtherMaterialUseInLibraryCommand $command): void
    {
        $libraryCard = $this->otherMaterialRepository
            ->getById($command->getLibraryMaterialId())
            ->useInLibrary(
                $command,
                $this->policyBuilder,
                $this->actionBuilder,
                $this->clock->now()
            );
    }
}
