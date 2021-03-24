<?php

declare(strict_types=1);

namespace Library\Circulation\Tests\Behat;

use Behat\Behat\Context\Context;
use Library\SharedKernel\Infrastructure\Behat\BehaviourTestCaseTrait;

abstract class BehavioralTestCase implements Context
{
    use BehaviourTestCaseTrait;

    protected static function requirePhpUnit(): void
    {
        require_once __DIR__ . '/../../bin/.phpunit/phpunit-8.5-0/vendor/autoload.php';
    }
}
