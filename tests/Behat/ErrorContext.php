<?php

declare(strict_types=1);

namespace Library\Circulation\Tests\Behat;

use ErrorException;
use Library\SharedKernel\Infrastructure\Behat\Exception\ExpectedErrorHasNotBeenThrown;

trait ErrorContext
{
    public ?ErrorException $error = null;

    /**
     * @Then /^I see error says "([^"]*)"$/
     * @param string $errorMessage
     * @throws \Library\SharedKernel\Infrastructure\Behat\Exception\ExpectedErrorHasNotBeenThrown
     */
    public function iSeeErrorSays(string $errorMessage): void
    {
        if (!$this->error) {
            throw ExpectedErrorHasNotBeenThrown::forExpectedMessage($errorMessage);
        }

        if ($this->error->getMessage() !== $errorMessage) {
            throw ExpectedErrorHasNotBeenThrown::gotActualMessageInstead($this->error->getMessage());
        }
    }
}
