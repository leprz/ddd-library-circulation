<?php

declare(strict_types=1);

namespace Library\Circulation\Tests\UseCase\BookCheckOut\Application;

use Doctrine\DBAL\ConnectionException;
use Doctrine\DBAL\Exception\DriverException;
use Doctrine\DBAL\Exception\ServerException;
use Doctrine\ORM\EntityManagerInterface;
use Library\Circulation\Common\Application\Date\ClockInterface;
use Library\Circulation\Common\Application\Exception\EntityNotFoundException;
use Library\Circulation\Common\Domain\Error\DomainErrorException;
use Library\Circulation\Common\Infrastructure\DataFixtures\ReferenceFixture;
use Library\Circulation\Common\Infrastructure\Date\DateTimeBuilder;
use Library\Circulation\Core\Book\Domain\Error\ItemsLimitExceededErrorException;
use Library\Circulation\Core\LibraryCard\Application\LibraryCardPersistenceInterface;
use Library\Circulation\Core\LibraryCard\Domain\Error\FinancialRulesViolationErrorException;
use Library\Circulation\Core\LibraryCard\Domain\Error\LibraryMaterialAlreadyBorrowedErrorException;
use Library\Circulation\Core\LibraryMaterial\Domain\Error\LibraryMaterialNotForCheckOutErrorException;
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
     * @var \Library\Circulation\UseCase\BookCheckOut\Application\BookCheckOutHandler
     */
    private BookCheckOutHandler $sut;

    private EntityManagerInterface $entityManager;

    /**
     * @test
     * @small
     */
    public function check_out(): void
    {
        $this->assertLibraryCardHasBeenSaved();

        /** @noinspection PhpUnhandledExceptionInspection */
        ($this->sut)(
            $this->getBookCheckOutCommand()
        );
    }

    /**
     * @test
     * @small
     */
    public function handle_database_downtime(): void
    {
        $command = $this->getBookCheckOutCommand();
        try {
            $test = $this->entityManager->getConnection()->connect();
        } catch (\Doctrine\DBAL\Exception\ConnectionException $e) {
            // put command on the queue
            echo "Errror";
        }

        try {
            ($this->sut)(
                $command
            );
        } catch (EntityNotFoundException $e) {
        } catch (DomainErrorException $e) {
        }
    }

    protected function setUp(): void
    {
        $this->entityManager = $this->resolve(EntityManagerInterface::class);
        $this->libraryCardPersistenceStub = $this->bindMock(LibraryCardPersistenceInterface::class);

        $this->bindInstance(ClockInterface::class, new ClockStub(DateTimeBuilder::fromString('2020-01-01')));

        $this->sut = $this->resolve(BookCheckOutHandler::class);
    }

    private function assertLibraryCardHasBeenSaved(): void
    {
        $this->libraryCardPersistenceStub->expects(self::once())->method('save');
    }

    /**
     * @return \Library\Circulation\UseCase\BookCheckOut\Application\BookCheckOutCommand
     */
    private function getBookCheckOutCommand(): BookCheckOutCommand
    {
        return new BookCheckOutCommand(
            LibraryMaterialId::fromString(ReferenceFixture::$BOOK_ID),
            PatronId::fromString(ReferenceFixture::$PATRON_ID),
            PatronType::graduateStudent(),
        );
    }
}
