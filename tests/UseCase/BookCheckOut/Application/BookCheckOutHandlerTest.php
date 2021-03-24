<?php

declare(strict_types=1);

namespace Library\Circulation\Tests\UseCase\BookCheckOut\Application;

use Library\Circulation\Common\Application\Date\ClockInterface;
use Library\Circulation\Common\Infrastructure\DataFixtures\ReferenceFixture;
use Library\Circulation\Common\Infrastructure\Date\DateTimeBuilder;
use Library\Circulation\Core\LibraryCard\Application\LibraryCardPersistenceInterface;
use Library\Circulation\Core\LibraryMaterial\Domain\LibraryMaterialId;
use Library\Circulation\Core\Patron\Domain\PatronId;
use Library\Circulation\Core\Patron\Domain\PatronType;
use Library\Circulation\Tests\Common\Fake\ClockStub;
use Library\Circulation\Tests\KernelTestCase;
use Library\Circulation\UseCase\BookCheckOut\Application\BookCheckOutCommand;
use Library\Circulation\UseCase\BookCheckOut\Application\BookCheckOutHandler;
use PHPUnit\Framework\MockObject\MockObject;

class BookCheckOutHandlerTest extends KernelTestCase
{


    /**
     * @var \Library\Circulation\Core\LibraryCard\Application\LibraryCardPersistenceInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    private MockObject|LibraryCardPersistenceInterface $libraryCardPersistenceStub;


    /**
     * @test
     * @small
     */
    public function check_out(): void
    {
        $this->assertLibraryCardHasBeenSaved();

        ($this->sut)(
            new BookCheckOutCommand(
                LibraryMaterialId::fromString(ReferenceFixture::$BOOK_ID),
                PatronId::fromString(ReferenceFixture::$PATRON_ID),
                PatronType::graduateStudent(),
            )
        );
    }

    protected function setUp(): void
    {
        $this->libraryCardPersistenceStub = $this->bindMock(LibraryCardPersistenceInterface::class);

        $this->bindInstance(ClockInterface::class, new ClockStub(DateTimeBuilder::fromString('2020-01-01')));

        $this->sut = $this->resolve(BookCheckOutHandler::class);
    }

    private function assertLibraryCardHasBeenSaved(): void
    {
        $this->libraryCardPersistenceStub->expects(self::once())->method('save');
    }
}
