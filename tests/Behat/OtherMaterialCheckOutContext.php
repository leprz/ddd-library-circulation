<?php

declare(strict_types=1);

namespace Library\Circulation\Tests\Behat;

use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use ErrorException;
use Library\Circulation\Common\Domain\OtherMaterialBorrow\OtherMaterialBorrowPolicyBuilder;
use Library\Circulation\Common\Infrastructure\Date\DateTimeBuilder;
use Library\Circulation\Core\Patron\Domain\PatronIdentity;
use Library\Circulation\Core\Patron\Domain\PatronType;
use Library\Circulation\Core\Satistics\Application\PatronBorrowedOtherMaterialsStatisticsRepositoryInterface;
use Library\Circulation\Tests\BehavioralTestCase;
use Library\Circulation\Tests\Common\TestData\PatronMother;
use Library\Circulation\UseCase\OtherMaterialCheckOut\Application\OtherMaterialCheckOutCommand;
use Library\Circulation\UseCase\OtherMaterialCheckOut\Domain\OtherMaterialCheckOutActionBuilderInterface;
use PHPUnit\Framework\MockObject\MockObject;

class OtherMaterialCheckOutContext extends BehavioralTestCase implements Context
{
    use OtherMaterialContext;
    use BorrowContext;
    private OtherMaterialBorrowPolicyBuilder $policyBuilder;
    private OtherMaterialCheckOutActionBuilderInterface $actionBuilder;
    private PatronBorrowedOtherMaterialsStatisticsRepositoryInterface|MockObject $otherMaterialBorrowStatisticsMock;

    /**
     * @When /^Me as a (.*) check out this material$/
     * @param string $patronType
     */
    public function meAsAGraduate_studentCheckOutThisAccessory(string $patronType): void
    {
        try {
            $this->myId = PatronMother::default();
            $this->borrowedAt = DateTimeBuilder::fromString('2020-01-01');
            $this->libraryCard = $this->otherMaterial->checkOut(
                new OtherMaterialCheckOutCommand(
                    new PatronIdentity(
                        $this->myId,
                        PatronType::fromString($patronType)
                    )
                ),
                $this->policyBuilder,
                $this->actionBuilder,
                $this->borrowedAt
            );
        } catch (ErrorException $error) {
            $this->error = $error;
        }
    }

    /**
     * @Given /^I got (\d+) not overdue material/
     * @param int $borrowedMaterialCount
     */
    public function iGotNotOverdueGames(int $borrowedMaterialCount): void
    {
        $this->otherMaterialBorrowStatisticsMock->method('countBorrowedBy')->willReturn($borrowedMaterialCount);
    }

    public function getOtherMaterialBorrowStatisticsMock(): MockObject
    {
        return $this->otherMaterialBorrowStatisticsMock;
    }

    protected function setUp(): void
    {
        $this->otherMaterialBorrowStatisticsMock = $this->bindMock(
            PatronBorrowedOtherMaterialsStatisticsRepositoryInterface::class
        );
        $this->policyBuilder = $this->resolve(OtherMaterialBorrowPolicyBuilder::class);
        $this->actionBuilder = $this->resolve(OtherMaterialCheckOutActionBuilderInterface::class);
    }

    /**
     * @Given /^I got (\d+) overdue material/
     * @param int $borrowedOverdueMaterialCount
     */
    public function iGotOverdueGame(int $borrowedOverdueMaterialCount): void
    {
        $this->otherMaterialBorrowStatisticsMock->method('countBorrowedOverdueBy')->willReturn(
            $borrowedOverdueMaterialCount
        );
    }
}
