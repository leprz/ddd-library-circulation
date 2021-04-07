<?php

declare(strict_types=1);

namespace Library\Circulation\Tests\Common\Infrastructure\EventBus;

use Library\Circulation\Common\Domain\DomainEvent\DomainBroadcastEvent;
use Library\Circulation\Common\Domain\DomainEvent\DomainEventBus;
use Library\Circulation\Common\Infrastructure\EventBus\EventBus;
use Library\Circulation\Core\Book\Domain\Book;
use Library\Circulation\Tests\KernelTestCase;
use Library\SharedKernel\Domain\Event\Circulation\BookCheckedInOverDueEvent;

class EventBusTest extends KernelTestCase
{
    private EventBus $sut;

    private DomainEventBus $eventDispatcher;

    /**
     * @test
     */
    public function all_events_are_dispatched_to_async_bus(): void
    {
        $this->eventDispatcher->dispatch(
            new DomainBroadcastEvent(
                new BookCheckedInOverDueEvent(
                    'test',
                    'test',
                    'test'
                ),
                Book::class
            )
        );

        $this->sut->dispatchAllDomainEvents();
    }

    protected function setUp(): void
    {
        $this->eventDispatcher = $this->resolve(DomainEventBus::class);
        $this->sut = $this->resolve(EventBus::class);
    }
}
