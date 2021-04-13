<?php

declare(strict_types=1);

namespace Library\Circulation\Core\Patron\Infrastructure;

use Library\Circulation\Common\Infrastructure\DataFixtures\ReferenceFixture;
use Library\Circulation\Core\Patron\Domain\PatronId;
use Library\Circulation\Core\Patron\Domain\PatronIdentity;
use Library\Circulation\Core\Patron\Domain\PatronType;

class PatronIdentityProvider
{
    public function getCurrentUser(): PatronIdentity
    {
        // TODO add real implementation
        return new PatronIdentity(PatronId::fromString(ReferenceFixture::$PATRON_ID), PatronType::undergraduateStudent());
    }
}
