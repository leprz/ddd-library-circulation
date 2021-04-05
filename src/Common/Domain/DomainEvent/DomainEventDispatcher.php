<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\DomainEvent;

use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\EventDispatcher\ListenerProviderInterface;
use Psr\EventDispatcher\StoppableEventInterface;

/**
 * Class EventDispatcher
 */
class DomainEventDispatcher implements EventDispatcherInterface
{
    /**
     * EventDispatcher constructor.
     * @param ListenerProviderInterface $listenerProvider
     * @param \Library\Circulation\Common\Domain\DomainEvent\DomainEventStore $eventStore
     */
    public function __construct(private ListenerProviderInterface $listenerProvider, private DomainEventStore $eventStore)
    {
    }

    /**
     * @param object $event
     * @return object
     */
    public function dispatch(object $event): object
    {
        if ($event instanceof DomainBroadcastEvent) {
            $this->eventStore->addEvent($event);
        }

        $stoppable = $event instanceof StoppableEventInterface;
        foreach ($this->listenerProvider->getListenersForEvent($event) as $listener) {
            if ($stoppable && $event->isPropagationStopped()) {
                return $event;
            }

            $listener($event);
        }
        return $event;
    }
}
