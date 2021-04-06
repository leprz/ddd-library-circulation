<?php

declare(strict_types=1);

namespace Library\Circulation\Tests\Behat;

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use ErrorException;
use Library\Circulation\Common\Domain\OtherMaterialBorrow\OtherMaterialBorrowPolicyBuilder;
use Library\Circulation\Common\Domain\ValueObject\Date;
use Library\Circulation\Common\Infrastructure\Date\DateTimeBuilder;
use Library\Circulation\Core\BusinessHours\Domain\BusinessHoursServiceInterface;
use Library\Circulation\Core\LibraryMaterial\Domain\LibraryMaterialId;
use Library\Circulation\Core\Patron\Domain\PatronIdentity;
use Library\Circulation\Core\Patron\Domain\PatronType;
use Library\Circulation\Core\Satistics\Application\PatronBorrowedOtherMaterialsStatisticsRepositoryInterface;
use Library\Circulation\Tests\BehavioralTestCase;
use Library\Circulation\Tests\Common\TestData\LibraryCardMother;
use Library\Circulation\Tests\Common\TestData\OtherMaterialMother;
use Library\Circulation\Tests\Common\TestData\PatronMother;
use Library\Circulation\UseCase\OtherMaterialUseInLibrary\Application\OtherMaterialUseInLibraryActionBuilder;
use Library\Circulation\UseCase\OtherMaterialUseInLibrary\Application\OtherMaterialUseInLibraryCommand;
use Library\Circulation\UseCase\OtherMaterialUseInLibrary\Domain\OtherMaterialUseInLibraryActionBuilderInterface;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\MockObject\MockObject;

class UseInLibraryContext extends BehavioralTestCase implements Context
{
    use BorrowContext;
    use OtherMaterialContext;
    use CurrentTimeContext;

    private OtherMaterialBorrowPolicyBuilder $policyBuilder;
    private OtherMaterialUseInLibraryActionBuilder $actionBuilder;
    private BusinessHoursServiceInterface|MockObject $businessHoursServiceMock;
    private MockObject|PatronBorrowedOtherMaterialsStatisticsRepositoryInterface $otherMaterialBorrowStatisticsMock;

    protected function todayIs(): Date
    {
        return $this->borrowedAt->asDate();
    }

    /**
     * @When /^Me as a graduate_student borrow this material for in\-library use$/
     */
    public function meAsAGraduate_studentBorrowThisMaterialForInLibraryUse(): void
    {
        try {
            $this->borrowedAt = $this->now ?? $this->borrowedAt;

            $this->libraryCard = $this->otherMaterial->useInLibrary(
                new OtherMaterialUseInLibraryCommand(
                    LibraryMaterialId::fromString('699DF88D-35FF-4BD6-BBF4-A2BADCD129EE'),
                    new PatronIdentity(
                        PatronMother::default(),
                        PatronType::undergraduateStudent()
                    )
                ),
                $this->policyBuilder,
                $this->actionBuilder,
                $this->borrowedAt,
            );
        } catch (ErrorException $error) {
            $this->error = $error;
        }
    }

    /**
     * @Given /^Library is closing at (.*)$/
     * @param string $time
     */
    public function libraryIsClosingAt17(string $time): void
    {
        $this->businessHoursServiceMock->method('getEndOfBusinessFor')->willReturn(
            DateTimeBuilder::fromString("2020-01-01 $time:00")
        );
    }

    /**
     * @Then /^I must return that item at (.*) the same day$/
     * @param string $time
     */
    public function iMustReturnThatItemAt16TheSameDay(string $time): void
    {
        $dueDateDateTime = LibraryCardMother::readDueDate($this->libraryCard)->toDateTime();
        [$hour, $minutes] = explode(':', $time);
        $expectedDueDate = $dueDateDateTime->setTime((int)$hour, (int)$minutes, 00);
        Assert::assertTrue(
            $dueDateDateTime->equals(
                $expectedDueDate
            ),
            $dueDateDateTime->format('H:i') . " does not match expected " . $expectedDueDate->format('H:i')
        );
    }

    function getOtherMaterialBorrowStatisticsMock(): MockObject
    {
        return $this->otherMaterialBorrowStatisticsMock;
    }

    /**
     * @Given /^There is a Mac VGA adapter$/
     */
    public function thereIsAMacVGAAdapter()
    {
        $this->otherMaterial = OtherMaterialMother::macVgaAdapter();
    }

    protected function setUp(): void
    {
        $this->borrowedAt = DateTimeBuilder::fromString('2020-01-01 10:00:00');
        $this->businessHoursServiceMock = $this->bindMock(BusinessHoursServiceInterface::class);
        $this->otherMaterialBorrowStatisticsMock = $this->bindMock(
            PatronBorrowedOtherMaterialsStatisticsRepositoryInterface::class
        );
        $this->policyBuilder = $this->resolve(OtherMaterialBorrowPolicyBuilder::class);
        $this->actionBuilder = $this->resolve(OtherMaterialUseInLibraryActionBuilderInterface::class);
    }
}
