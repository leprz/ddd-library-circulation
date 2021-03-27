<?php

declare(strict_types=1);

namespace Library\Circulation\Core\Patron\Domain;

class PatronIdentity
{
    public function __construct(private PatronId $patronId, private PatronType $type)
    {
    }

    public function getPatronId(): PatronId
    {
        return $this->patronId;
    }

    public function getType(): PatronType
    {
        return $this->type;
    }
}
