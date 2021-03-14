<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\Book\Error;

use Library\Circulation\Common\Domain\Error\DomainErrorException;

class BorrowLimitExceededErrorException extends DomainErrorException
{

}
