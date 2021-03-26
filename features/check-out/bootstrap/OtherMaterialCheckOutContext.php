<?php

declare(strict_types=1);

namespace Library\Tests;

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Library\Circulation\Core\OtherMaterial\Domain\OtherMaterial;
use Library\Circulation\Tests\BehavioralTestCase;
use Library\Circulation\Tests\Common\TestData\OtherMaterialMother;

class OtherMaterialCheckOutContext extends BehavioralTestCase implements Context
{
    private OtherMaterial $otherMaterial;

    /**
     * @Given /^There is an available calculator$/
     */
    public function thereIsAvailableCalculator()
    {
        $this->otherMaterial = OtherMaterialMother::calculator();
    }

    /**
     * @When /^Me as a graduate_student check out this accessory$/
     */
    public function meAsAGraduate_studentCheckOutThisAccessory()
    {
        throw new PendingException();
    }
}
