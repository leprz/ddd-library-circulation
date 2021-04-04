<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Domain\LibraryCardReturn;

use Library\Circulation\Common\Domain\ValueObject\DateTime;

/**
 * @package Library\Circulation\Common\Domain\LibraryMaterialReturn
 */
interface LibraryCardReturnDataInterface
{
    public function getReturnedAt(): DateTime;
}
