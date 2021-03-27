<?php

declare(strict_types=1);

namespace Library\Circulation\Tests\Behat;

use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use ErrorException;
use Library\Circulation\Common\Infrastructure\Date\DateTimeBuilder;
use Library\Circulation\Core\OtherMaterial\Domain\OtherMaterial;
use Library\Circulation\Core\Patron\Domain\PatronIdentity;
use Library\Circulation\Core\Patron\Domain\PatronType;
use Library\Circulation\Core\Satistics\Application\PatronBorrowedOtherMaterialsStatisticsRepositoryInterface;
use Library\Circulation\Tests\BehavioralTestCase;
use Library\Circulation\Tests\Common\TestData\OtherMaterialMother;
use Library\Circulation\Tests\Common\TestData\PatronMother;
use Library\Circulation\UseCase\OtherMaterialCheckOut\Application\OtherMaterialCheckOutCommand;
use Library\Circulation\UseCase\OtherMaterialCheckOut\Domain\OtherMaterialCheckOutActionBuilderInterface;
use Library\Circulation\UseCase\OtherMaterialCheckOut\Domain\OtherMaterialCheckOutPolicyBuilder;
use PHPUnit\Framework\MockObject\MockObject;

class OtherMaterialCheckOutContext extends BehavioralTestCase implements Context
{
    private OtherMaterial $otherMaterial;
    private OtherMaterialCheckOutPolicyBuilder $policyBuilder;
    private OtherMaterialCheckOutActionBuilderInterface $actionBuilder;
    private ErrorException $error;
    private CheckOutContext $checkOutContext;
    private PatronBorrowedOtherMaterialsStatisticsRepositoryInterface|MockObject $otherMaterialBorrowStatisticsMock;

    /**
     * @Given /^There is an calculator$/
     */
    public function thereIsAvailableCalculator()
    {
        $this->otherMaterial = OtherMaterialMother::calculator();
    }

    /**
     * @When /^Me as a (.*) check out this material$/
     */
    public function meAsAGraduate_studentCheckOutThisAccessory(string $patronType)
    {
        try {
            $this->checkOutContext->myId = PatronMother::default();
            $this->checkOutContext->borrowedAt = DateTimeBuilder::fromString('2020-01-01');
            $this->checkOutContext->libraryCard = $this->otherMaterial->checkOut(
                new OtherMaterialCheckOutCommand(
                    new PatronIdentity(
                        $this->checkOutContext->myId,
                        PatronType::fromString($patronType)
                    )
                ),
                $this->policyBuilder,
                $this->actionBuilder,
                $this->checkOutContext->borrowedAt
            );
        } catch (ErrorException $error) {
            $this->checkOutContext->error = $error;
        }
    }

    /** @BeforeScenario */
    public function before(BeforeScenarioScope $scope)
    {
        $environment = $scope->getEnvironment();
        $this->checkOutContext = $environment->getContext(CheckOutContext::class);
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
     */
    public function iGotNotOverdueGames(int $borrowedMaterialCount)
    {
        $this->otherMaterialBorrowStatisticsMock->method('countBorrowedBy')->willReturn($borrowedMaterialCount);
    }

    protected function setUp(): void
    {
        $this->otherMaterialBorrowStatisticsMock = $this->bindMock(
            PatronBorrowedOtherMaterialsStatisticsRepositoryInterface::class
        );
        $this->policyBuilder = $this->resolve(OtherMaterialCheckOutPolicyBuilder::class);
        $this->actionBuilder = $this->resolve(OtherMaterialCheckOutActionBuilderInterface::class);
    }

    /**
     * @Given /^I got (\d+) overdue material/
     */
    public function iGotOverdueGame(int $borrowedOverdueMaterialCount)
    {
        $this->otherMaterialBorrowStatisticsMock->method('countBorrowedOverdueBy')->willReturn(
            $borrowedOverdueMaterialCount
        );
    }
}
