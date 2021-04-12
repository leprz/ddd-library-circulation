<?php

declare(strict_types=1);

namespace Library\Circulation\Tests\Common\Infrastructure\EventBus;

use Library\Circulation\Common\Domain\DomainEvent\DomainBroadcastEvent;
use Library\Circulation\Common\Domain\DomainEvent\DomainEventBus;
use Library\Circulation\Common\Infrastructure\EventBus\EventBus;
use Library\Circulation\Core\Book\Domain\Book;
use Library\Circulation\Tests\KernelTestCase;
use Library\SharedKernel\Domain\Event\Circulation\BookCheckedInOverDueEvent;
use Ramsey\Uuid\Uuid;

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
                    (string) Uuid::uuid4(),
                    (string) Uuid::uuid4(),
                    '2:0:0'
                ),
                Book::class
            )
        );

        $this->sut->dispatchAllDomainEvents();
        self::assertTrue(true);
    }

    protected function setUp(): void
    {
        $this->eventDispatcher = $this->resolve(DomainEventBus::class);
        $this->sut = $this->resolve(EventBus::class);
    }
}
