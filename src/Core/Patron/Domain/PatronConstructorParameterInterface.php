<?php

declare(strict_types=1);

namespace Library\Circulation\Core\Patron\Domain;

/**
 * @package Library\Circulation\Core\Patron\Domain
 */
interface PatronConstructorParameterInterface
{
    public function getPatronId(): PatronId;

    public function getPatronType(): PatronType;
}
