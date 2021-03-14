<?php

declare(strict_types=1);

namespace Library\Circulation\Tests\UseCase\BookCheckOut\Application;

use Library\Circulation\Common\Application\Persistence\LibraryCardPersistenceInterface;
use Library\Circulation\Common\Domain\LibraryCard\LibraryCardId;
use Library\Circulation\Common\Domain\Patron\PatronId;
use Library\Circulation\Common\Domain\Patron\PatronType;
use Library\Circulation\Common\Infrastructure\DataFixtures\ReferenceFixture;
use Library\Circulation\Tests\KernelTestCase;
use Library\Circulation\UseCase\BookCheckOut\Application\BookCheckOutCommand;
use Library\Circulation\UseCase\BookCheckOut\Application\BookCheckOutHandler;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\MockObject\Stub;

class BookCheckOutHandlerTest extends KernelTestCase
{
    /**
     * @var \Library\Circulation\UseCase\BookCheckOut\Application\BookCheckOutHandler
     */
    private BookCheckOutHandler $sut;

    /**
     * @var \Library\Circulation\Common\Application\Persistence\LibraryCardPersistenceInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    private MockObject|LibraryCardPersistenceInterface $libraryCardPersistenceStub;

    /**
     * @test
     * @small
     */
    public function check_out(): void
    {
        $this->assertLibraryCardHasBeenSaved();

        ($this->sut)(new BookCheckOutCommand(
            LibraryCardId::fromString(ReferenceFixture::$LIBRARY_CARD_ID),
            PatronId::fromString(ReferenceFixture::$PATRON_ID),
            PatronType::graduateStudent(),
        ));
    }

    protected function setUp(): void
    {
        $this->libraryCardPersistenceStub = $this->bindMock(LibraryCardPersistenceInterface::class);

        $this->sut = $this->resolve(BookCheckOutHandler::class);
    }

    private function assertLibraryCardHasBeenSaved(): void
    {
        $this->libraryCardPersistenceStub->expects(self::once())->method('save');
    }
}
