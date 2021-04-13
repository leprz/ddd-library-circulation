<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Infrastructure\Controller;

use ErrorException;
use Library\Circulation\Common\Application\Exception\NotFoundException;
use Library\SharedKernel\Infrastructure\Controller\ApiControllerTrait;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ApiController
{
    use ApiControllerTrait;

    protected function throwNotFoundHttpException(NotFoundException $e): void
    {
        throw new NotFoundHttpException($e->getMessage(), $e);
    }

    protected function throwBadRequestHttpException(ErrorException $e): void
    {
        throw new BadRequestHttpException($e->getMessage(), $e);
    }
}
