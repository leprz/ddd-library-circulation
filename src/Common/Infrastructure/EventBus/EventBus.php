<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Infrastructure\EventBus;

use Library\Circulation\Common\Domain\DomainEvent\DomainEventStore;
use Symfony\Component\Messenger\MessageBusInterface;

class EventBus
{
    public function __construct(private MessageBusInterface $bus, private DomainEventStore $eventStore)
    {
    }

    public function dispatchAllDomainEvents(): void
    {
        $allEvents = $this->eventStore->getAll();
        foreach ($allEvents as $event) {
            $this->bus->dispatch($event);
        }
    }
}
