<?php

declare(strict_types=1);

namespace Library\Circulation\Tests\Behat;

use Library\Circulation\Core\OtherMaterial\Domain\OtherMaterial;
use Library\Circulation\Tests\Common\TestData\OtherMaterialMother;
use PHPUnit\Framework\MockObject\MockObject;

trait OtherMaterialContext
{
    public OtherMaterial $otherMaterial;

    /**
     * @Given /^There is an calculator$/
     */
    public function thereIsAvailableCalculator()
    {
        $this->otherMaterial = OtherMaterialMother::calculator();
    }

    /**
     * @Given /^There is a game$/
     */
    public function thereIsAGame()
    {
        $this->otherMaterial = OtherMaterialMother::game();
    }

    /**
     * @Given /^I got (\d+) not overdue material/
     * @param int $borrowedMaterialCount
     */
    public function iGotNotOverdueGames(int $borrowedMaterialCount): void
    {
        $this->getOtherMaterialBorrowStatisticsMock()->method('countBorrowedBy')->willReturn($borrowedMaterialCount);
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\Library\Circulation\Core\Satistics\Application\PatronBorrowedOtherMaterialsStatisticsRepositoryInterface
     */
    abstract public function getOtherMaterialBorrowStatisticsMock(): MockObject;
}
