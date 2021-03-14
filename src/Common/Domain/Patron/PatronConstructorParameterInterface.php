<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\Patron;

/**
 * @package Library\Circulation\Common\Domain\Patron
 */
interface PatronConstructorParameterInterface
{
    public function getPatronId(): PatronId;

    public function getPatronType(): PatronType;
}
