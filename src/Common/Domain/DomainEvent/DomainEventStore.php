<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\DomainEvent;

class DomainEventStore implements DomainEventStoreInterface
{
    /**
     * @var \Library\Circulation\Common\Domain\DomainEvent\DomainBroadcastEvent[]
     */
    private array $events = [];

    public function addEvent(DomainBroadcastEvent $event): void
    {
        $this->events[] = $event;
    }

    public function filterByEmitter(string $emitterClass): array
    {
        return array_map(
            static function (DomainBroadcastEvent $event): object {
                return $event->getRealEvent();
            },
            array_filter(
                $this->events,
                static function (DomainBroadcastEvent $event) use ($emitterClass): bool {
                    return $event->isEmittedBy($emitterClass);
                }
            )
        );
    }
}
