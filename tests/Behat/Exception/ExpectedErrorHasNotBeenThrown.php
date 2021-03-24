<?php

declare(strict_types=1);

namespace Library\Circulation\Tests\Behat\Exception;

use Exception;

class ExpectedErrorHasNotBeenThrown extends Exception
{
    /**
     * @throws \Library\Circulation\Tests\Behat\Exception\ExpectedErrorHasNotBeenThrown
     */
    public static function throw(): void
    {
        throw new self("Expected error has not been thrown");
    }
}
