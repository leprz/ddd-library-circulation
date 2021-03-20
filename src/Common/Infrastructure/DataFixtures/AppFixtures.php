<?php

namespace Library\Circulation\Common\Infrastructure\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Library\Circulation\Common\Domain\LibraryMaterial\LibraryMaterialId;
use Library\Circulation\Common\Domain\Patron\PatronId;
use Library\Circulation\Common\Infrastructure\Entity\BookEntity;
use Library\Circulation\Common\Infrastructure\Entity\PatronEntity;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $this->createPatron(
            ReferenceFixture::$PATRON_ID,
            $manager
        );

        $this->createBook(
            ReferenceFixture::$BOOK_ID,
            $manager
        );

        $manager->flush();
    }

    private function createPatron(string $id, ObjectManager $manager): void
    {
        $patron = new PatronEntity(
            PatronId::fromString($id)
        );
        $manager->persist($patron);

        $this->setReference($id, $patron);
    }

    private function createBook(string $id, ObjectManager $manager): void
    {
        $book = new BookEntity(
            LibraryMaterialId::fromString($id)
        );
        $manager->persist($book);

        $this->setReference($id, $book);
    }
}
