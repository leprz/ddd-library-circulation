<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\DomainEvent;

use Psr\EventDispatcher\StoppableEventInterface;

class DomainBroadcastEvent implements StoppableEventInterface
{
    private bool $isPropagationStopped = false;
    private string $emitterClass;

    public function __construct(private object $event, string $emitter)
    {
        $this->emitterClass = $emitter;
    }

    protected function getEmitterClass(): string
    {
        return $this->emitterClass;
    }

    public function isEmittedBy(string $emitterClass): bool
    {
        return $this->getEmitterClass() === $emitterClass;
    }

    public function isPropagationStopped(): bool
    {
        return $this->isPropagationStopped;
    }

    public function stopPropagation(): void
    {
        $this->isPropagationStopped = true;
    }

    public function getRealEvent(): object
    {
        return $this->event;
    }
}
