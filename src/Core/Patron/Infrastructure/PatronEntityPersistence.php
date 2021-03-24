<?php

declare(strict_types=1);

namespace Library\Circulation\Core\Patron\Infrastructure;

use Library\Circulation\Core\Patron\Application\PatronPersistenceInterface;
use Library\Circulation\Core\Patron\Domain\Patron;

/**
 * @package Library\Circulation\Core\Patron\Infrastructure
 */
class PatronEntityPersistence implements PatronPersistenceInterface
{
    /**
     * @return void
     */
    public function flush(): void
    {
    }

    /**
     * @param \Library\Circulation\Core\Patron\Domain\Patron
     * @return void
     */
    public function save(Patron $model): void
    {
    }

    /**
     * @param \Library\Circulation\Core\Patron\Domain\Patron
     * @return void
     */
    public function add(Patron $model): void
    {
    }
}
