<?php

declare(strict_types=1);

namespace Library\Circulation\Tests;

use Library\Circulation\Tests\Behat\ErrorContext;
use Library\SharedKernel\Infrastructure\Behat\BehaviourTestCaseTrait;

abstract class BehavioralTestCase
{
    use BehaviourTestCaseTrait;
    use ErrorContext;

    protected static function requirePhpUnit(): void
    {
        require_once __DIR__ . '/../bin/.phpunit/phpunit-8.5-0/vendor/autoload.php';
    }
}
