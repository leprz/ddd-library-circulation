<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Application\Persistence;

use Library\Circulation\Common\Domain\Patron\Patron;

/**
 * @package Library\Circulation\Common\Application\Persistence
 */
interface PatronRepositoryInterface
{
    /**
     * @return \Library\Circulation\Common\Domain\Patron\Patron
     */
    public function getById(): Patron;
}
