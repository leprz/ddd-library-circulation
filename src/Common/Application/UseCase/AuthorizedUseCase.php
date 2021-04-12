<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Application\UseCase;

abstract class AuthorizedUseCase
{
    public function __construct()
    {
        $this->authorize();
    }

    abstract protected function authorize(): void;
}
