<?php

declare(strict_types=1);

namespace Library\Circulation\Core\Patron\Domain;

use Library\Circulation\UseCase\PatronRegister\Domain\PatronRegisterDataInterface;

/**
 * @package Library\Circulation\Core\Patron\Domain
 */
class Patron
{
    private PatronId $id;

    private PatronType $type;

    /**
     * @param \Library\Circulation\Core\Patron\Domain\PatronConstructorParameterInterface
     */
    public function __construct(PatronConstructorParameterInterface $data)
    {
        $this->id = $data->getPatronId();
        $this->type = $data->getPatronType();
    }

    public static function register(PatronRegisterDataInterface $data): self
    {
        return new self($data);
    }
}
