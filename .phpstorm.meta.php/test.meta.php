<?php

declare(strict_types=1);

namespace PHPSTORM_META {

    use Doctrine\ORM\EntityManagerInterface;
    use Library\Circulation\Tests\BehavioralTestCase;
    use Library\Circulation\Tests\KernelTestCase;
    use Library\SharedKernel\Infrastructure\Behat\BehaviourTestCaseTrait;

    override(KernelTestCase::resolve(), type(0));
    override(KernelTestCase::bindStub(), type(0));
    override(KernelTestCase::bindMock(), type(0));
    override(EntityManagerInterface::getReference(), type(0));
    override(BehaviourTestCaseTrait::resolve(0), type(0));
    override(BehaviourTestCaseTrait::bindMock(0), type(0));

}
