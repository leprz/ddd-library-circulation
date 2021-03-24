<?php

declare(strict_types=1);

namespace Library\Circulation\Tests\Common\TestData;

use Library\Circulation\Common\Infrastructure\DataFixtures\ReferenceFixture;
use Library\Circulation\Core\Patron\Domain\PatronId;

class PatronMother
{
    public static function default(): PatronId
    {
        return PatronId::fromString(ReferenceFixture::$PATRON_ID);
    }

    public static function notDefault(): PatronId
    {
        return PatronId::fromString(ReferenceFixture::$ANOTHER_PATRON_ID);
    }
}
