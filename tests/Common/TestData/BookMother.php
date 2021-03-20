<?php

declare(strict_types=1);

namespace Library\Circulation\Tests\Common\TestData;

use Library\Circulation\Common\Domain\LibraryMaterial\LibraryMaterialId;
use Library\Circulation\Common\Infrastructure\DataFixtures\ReferenceFixture;

class BookMother
{
    public static function default(): LibraryMaterialId
    {
        return LibraryMaterialId::fromString(ReferenceFixture::$BOOK_ID);
    }
}
