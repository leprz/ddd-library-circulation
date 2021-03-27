<?php

declare(strict_types=1);

namespace Library\Circulation\Tests\Behat;

use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Behat\Tester\Exception\PendingException;
use ErrorException;
use Library\Circulation\Common\Infrastructure\Date\DateTimeBuilder;
use Library\Circulation\Core\LibraryCard\Domain\LibraryCard;
use Library\Circulation\Core\OtherMaterial\Domain\OtherMaterial;
use Library\Circulation\Core\Patron\Domain\PatronId;
use Library\Circulation\Core\Patron\Domain\PatronIdentity;
use Library\Circulation\Core\Patron\Domain\PatronType;
use Library\Circulation\Tests\BehavioralTestCase;
use Library\Circulation\Tests\Common\TestData\OtherMaterialMother;
use Library\Circulation\Tests\Common\TestData\PatronMother;
use Library\Circulation\UseCase\OtherMaterialCheckOut\Application\OtherMaterialCheckOutCommand;
use Library\Circulation\UseCase\OtherMaterialCheckOut\Domain\OtherMaterialCheckOutActionInterface;
use Library\Circulation\UseCase\OtherMaterialCheckOut\Domain\OtherMaterialCheckOutPolicyBuilder;

class OtherMaterialCheckOutContext extends BehavioralTestCase implements Context
{
    private OtherMaterial $otherMaterial;
    private OtherMaterialCheckOutActionInterface $action;
    private OtherMaterialCheckOutPolicyBuilder $policyBuilder;
    private ErrorException $error;
    private CheckOutContext $bookContext;

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
            $this->bookContext->myId = PatronMother::default();
            $this->bookContext->libraryCard = $this->otherMaterial->checkOut(
                new OtherMaterialCheckOutCommand(
                    new PatronIdentity(
                        $this->bookContext->myId,
                        PatronType::fromString($patronType)
                    )
                ),
                $this->policyBuilder,
                $this->action,
                DateTimeBuilder::fromString('2020-01-01')
            );
        } catch (ErrorException $error) {
            $this->bookContext->error = $error;
        }
    }

    /** @BeforeScenario */
    public function before(BeforeScenarioScope $scope)
    {
        $environment = $scope->getEnvironment();
        $this->bookContext = $environment->getContext(CheckOutContext::class);
    }

    /**
     * @Given /^There is a game$/
     */
    public function thereIsAGame()
    {
        $this->otherMaterial = OtherMaterialMother::game();
    }

    protected function setUp(): void
    {
        $this->policyBuilder = $this->resolve(OtherMaterialCheckOutPolicyBuilder::class);
        $this->action = $this->resolve(OtherMaterialCheckOutActionInterface::class);
    }
}
