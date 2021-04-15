<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Application\Retry;

interface RetryDirectorInterface
{
    public function watch(RetryInterface $command, object $handler): void;
}
