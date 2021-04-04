<?php

declare(strict_types=1);

namespace Library\Circulation\Core\OtherMaterial\Domain;

use Library\Circulation\Common\Domain\OtherMaterialBorrow\OtherMaterialBorrowPolicyBuilder;
use Library\Circulation\Common\Domain\ValueObject\DateTime;
use Library\Circulation\Core\LibraryCard\Domain\LibraryCard;
use Library\Circulation\Core\LibraryMaterial\Domain\LibraryMaterial;
use Library\Circulation\UseCase\OtherMaterialCheckOut\Domain\OtherMaterialCheckOutActionBuilderInterface;
use Library\Circulation\UseCase\OtherMaterialCheckOut\Domain\OtherMaterialCheckOutDataInterface;
use Library\Circulation\UseCase\OtherMaterialUseInLibrary\Domain\OtherMaterialUseInLibraryActionBuilderInterface;
use Library\Circulation\UseCase\OtherMaterialUseInLibrary\Domain\OtherMaterialUseInLibraryDataInterface;

/**
 * @package Library\Circulation\Core\OtherMaterial\Domain
 */
class OtherMaterial extends LibraryMaterial
{
    private string $name;

    private OtherMaterialType $type;

    public function __construct(OtherMaterialConstructorParameterInterface $data, LibraryCard $libraryCard)
    {
        $this->name = $data->getName();
        $this->type = $data->getType();
        parent::__construct($data->isForInLibraryUseOnly(), $libraryCard);
    }

    /**
     * @param \Library\Circulation\UseCase\OtherMaterialCheckOut\Domain\OtherMaterialCheckOutDataInterface $data
     * @param \Library\Circulation\Common\Domain\OtherMaterialBorrow\OtherMaterialBorrowPolicyBuilder $policyBuilder
     * @param \Library\Circulation\UseCase\OtherMaterialCheckOut\Domain\OtherMaterialCheckOutActionBuilderInterface $actionBuilder
     * @param \Library\Circulation\Common\Domain\ValueObject\DateTime $checkOutAt
     * @return \Library\Circulation\Core\LibraryCard\Domain\LibraryCard
     * @throws \Library\Circulation\Core\Book\Domain\Error\ItemsLimitExceededErrorException
     * @throws \Library\Circulation\Core\LibraryCard\Domain\Error\FinancialRulesViolationErrorException
     * @throws \Library\Circulation\Core\LibraryCard\Domain\Error\LibraryMaterialAlreadyBorrowedErrorException
     * @throws \Library\Circulation\Core\LibraryMaterial\Domain\Error\LibraryMaterialNotForCheckOutErrorException
     */
    public function checkOut(
        OtherMaterialCheckOutDataInterface $data,
        OtherMaterialBorrowPolicyBuilder $policyBuilder,
        OtherMaterialCheckOutActionBuilderInterface $actionBuilder,
        DateTime $checkOutAt
    ): LibraryCard {
        $this->assertCanBeUsedOutsideLibrary();

        return $this->lendLibraryCard(
            $data,
            $policyBuilder->getPolicy($this->type),
            $actionBuilder->getAction($this->type),
            $checkOutAt
        );
    }

    /**
     * @param \Library\Circulation\UseCase\OtherMaterialUseInLibrary\Domain\OtherMaterialUseInLibraryDataInterface $data
     * @param \Library\Circulation\Common\Domain\OtherMaterialBorrow\OtherMaterialBorrowPolicyBuilder $policyBuilder
     * @param \Library\Circulation\UseCase\OtherMaterialUseInLibrary\Domain\OtherMaterialUseInLibraryActionBuilderInterface $actionBuilder
     * @param \Library\Circulation\Common\Domain\ValueObject\DateTime $borrowedAt
     * @return \Library\Circulation\Core\LibraryCard\Domain\LibraryCard
     * @throws \Library\Circulation\Core\Book\Domain\Error\ItemsLimitExceededErrorException
     * @throws \Library\Circulation\Core\LibraryCard\Domain\Error\FinancialRulesViolationErrorException
     * @throws \Library\Circulation\Core\LibraryCard\Domain\Error\LibraryMaterialAlreadyBorrowedErrorException
     */
    public function useInLibrary(
        OtherMaterialUseInLibraryDataInterface $data,
        OtherMaterialBorrowPolicyBuilder $policyBuilder,
        OtherMaterialUseInLibraryActionBuilderInterface $actionBuilder,
        DateTime $borrowedAt,
    ): LibraryCard {
        return $this->lendLibraryCard(
            $data,
            $policyBuilder->getPolicy($this->type),
            $actionBuilder->getAction($this->type),
            $borrowedAt
        );
    }
}
