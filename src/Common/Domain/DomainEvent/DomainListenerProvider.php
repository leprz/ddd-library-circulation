<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\DomainEvent;

use Psr\EventDispatcher\ListenerProviderInterface;

class DomainListenerProvider implements ListenerProviderInterface
{
    /**
     * @var array<string, array<array-key, callable>
     */
    private array $listeners = [];

    /**
     * @param object $event
     *   An event for which to return the relevant listeners.
     * @return iterable[callable]
     *   An iterable (array, iterator, or generator) of callables.  Each
     *   callable MUST be type-compatible with $event.
     */
    public function getListenersForEvent(object $event): iterable
    {
        $eventType = $event::class;
        if (\array_key_exists($eventType, $this->listeners)) {
            return $this->listeners[$eventType];
        }

        return [];
    }

    /**
     * @param string $eventType
     * @param callable $callable
     * @return self
     */
    public function addListener(string $eventType, callable $callable): self
    {
        $this->listeners[$eventType][] = $callable;
        return $this;
    }

    /**
     * @param string $eventType
     */
    public function clearListeners(string $eventType): void
    {
        if (\array_key_exists($eventType, $this->listeners)) {
            unset($this->listeners[$eventType]);
        }
    }
}
