<?php

declare(strict_types=1);

namespace Library\Circulation\UseCase\PatronRegister\Application;

use Library\Circulation\Core\Patron\Domain\PatronId;
use Library\Circulation\Core\Patron\Domain\PatronType;
use Library\Circulation\UseCase\PatronRegister\Domain\PatronRegisterDataInterface;

/**
 * @package Library\Circulation\UseCase\PatronRegister\Application
 */
class PatronRegisterCommand implements PatronRegisterDataInterface
{
    public function getPatronId(): PatronId
    {
        // TODO: Implement getPatronId() method.
    }

    public function getPatronType(): PatronType
    {
        // TODO: Implement getPatronType() method.
    }
}
