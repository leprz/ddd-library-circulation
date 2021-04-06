<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Infrastructure\EventBus;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Log\Logger;

class OnKernelTerminate
{
    public function __construct(private EventBus $eventBus, private LoggerInterface $logger)
    {
    }

    public function __invoke()
    {
        $this->logger->info('Event dispatched');
        $this->eventBus->dispatchAllDomainEvents();
    }
}
