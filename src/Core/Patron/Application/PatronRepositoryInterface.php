<?php

declare(strict_types=1);

namespace Library\Circulation\Core\Patron\Application;

use Library\Circulation\Core\Patron\Domain\Patron;

/**
 * @package Library\Circulation\Common\Application\Persistence
 */
interface PatronRepositoryInterface
{
    /**
     * @return \Library\Circulation\Core\Patron\Domain\Patron
     */
    public function getById(): Patron;
}
