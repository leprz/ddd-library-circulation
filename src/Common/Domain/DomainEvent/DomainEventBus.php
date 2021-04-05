<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\DomainEvent;

use Psr\EventDispatcher\EventDispatcherInterface;

class DomainEventBus implements EventDispatcherInterface
{
    public function __construct(private DomainEventDispatcher $eventDispatcher, private DomainListenerProvider $listenerProvider)
    {
    }

    public function dispatch(object $event): object
    {
        return $this->eventDispatcher->dispatch($event);
    }

    public function subscribe(string $eventClass, callable $listener): void
    {
        $this->listenerProvider->addListener($eventClass, $listener);
    }
}
