<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Application\Persistence;

use Library\Circulation\Common\Domain\Patron\Patron;

/**
 * @package Library\Circulation\Common\Application\Persistence
 */
interface PatronPersistenceInterface
{
    /**
     * @return void
     */
    public function flush(): void;

    /**
     * @param \Library\Circulation\Common\Domain\Patron\Patron
     * @return void
     */
    public function save(Patron $model): void;

    /**
     * @param \Library\Circulation\Common\Domain\Patron\Patron
     * @return void
     */
    public function add(Patron $model): void;
}
