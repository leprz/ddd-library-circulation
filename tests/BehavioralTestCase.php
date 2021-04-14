<?php

declare(strict_types=1);

namespace Library\Circulation\Tests;

use Library\SharedKernel\Infrastructure\Behat\BehaviourTestCaseTrait;

abstract class BehavioralTestCase
{
    use BehaviourTestCaseTrait;

    protected static function requirePhpUnit(): void
    {
        require_once __DIR__ . '/../bin/.phpunit/phpunit-9.4-0/vendor/autoload.php';
    }
}
