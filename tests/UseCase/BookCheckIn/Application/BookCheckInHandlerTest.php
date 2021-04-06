<?php

declare(strict_types=1);

namespace Library\Circulation\Tests\UseCase\BookCheckIn\Application;

use Library\Circulation\Common\Domain\ValueObject\ReturnDateTime;
use Library\Circulation\Common\Infrastructure\DataFixtures\ReferenceFixture;
use Library\Circulation\Common\Infrastructure\Date\DateTimeBuilder;
use Library\Circulation\Core\LibraryMaterial\Domain\LibraryMaterialId;
use Library\Circulation\Core\Patron\Domain\PatronId;
use Library\Circulation\Tests\KernelTestCase;
use Library\Circulation\UseCase\BookCheckIn\Application\BookCheckInCommand;
use Library\Circulation\UseCase\BookCheckIn\Application\BookCheckInHandler;

class BookCheckInHandlerTest extends KernelTestCase
{
    private BookCheckInHandler $sut;

    /**
     * @test
     * @small
     */
    public function handle(): void
    {
        ($this->sut)(
            new BookCheckInCommand(
                LibraryMaterialId::fromString(ReferenceFixture::$BOOK_CHECKED_OUT),
                PatronId::fromString(ReferenceFixture::$PATRON_ID),
                new ReturnDateTime(DateTimeBuilder::fromString('2020-01-03'))
            )
        );
    }

    protected function setUp(): void
    {
        $this->sut = $this->resolve(BookCheckInHandler::class);
    }
}
