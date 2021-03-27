<?php

declare(strict_types=1);

namespace Library\Circulation\Core\OtherMaterial\Domain;

use Library\Circulation\Common\Domain\ValueObject\DateTime;
use Library\Circulation\Core\LibraryCard\Domain\LibraryCard;
use Library\Circulation\Core\LibraryMaterial\Domain\LibraryMaterial;
use Library\Circulation\UseCase\OtherMaterialCheckOut\Domain\OtherMaterialCheckOutActionInterface;
use Library\Circulation\UseCase\OtherMaterialCheckOut\Domain\OtherMaterialCheckOutDataInterface;
use Library\Circulation\UseCase\OtherMaterialCheckOut\Domain\OtherMaterialCheckOutPolicyBuilder;
use Library\Circulation\UseCase\OtherMaterialCheckOut\Domain\OtherMaterialPrivilegeBuilder;

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
     * @param \Library\Circulation\UseCase\OtherMaterialCheckOut\Domain\OtherMaterialCheckOutPolicyBuilder $policyBuilder
     * @param \Library\Circulation\UseCase\OtherMaterialCheckOut\Domain\OtherMaterialCheckOutActionInterface $action
     * @param \Library\Circulation\Common\Domain\ValueObject\DateTime $checkOutAt
     * @return \Library\Circulation\Core\LibraryCard\Domain\LibraryCard
     * @throws \Library\Circulation\Core\Book\Domain\Error\BorrowLimitExceededErrorException
     * @throws \Library\Circulation\Core\LibraryCard\Domain\Error\ItemAlreadyBorrowedErrorException
     * @throws \Library\Circulation\Core\LibraryMaterial\Domain\Error\LibraryMaterialBorrowErrorException
     */
    public function checkOut(
        OtherMaterialCheckOutDataInterface $data,
        OtherMaterialCheckOutPolicyBuilder $policyBuilder,
        OtherMaterialCheckOutActionInterface $action,
        DateTime $checkOutAt
    ): LibraryCard {
        return $this->lend(true, $data, $policyBuilder->getPolicy($this->type), $action, $checkOutAt);
    }
}
