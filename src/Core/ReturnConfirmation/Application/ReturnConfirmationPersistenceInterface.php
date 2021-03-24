<?php

declare(strict_types=1);

namespace Library\Circulation\Core\ReturnConfirmation\Application;

use Library\Circulation\Core\ReturnConfirmation\Domain\ReturnConfirmation;
use Library\Circulation\Core\ReturnConfirmation\Domain\ReturnConfirmationId;

/**
 * @package Library\Circulation\Common\Application\Persistence\ReturnConfirmation
 */
interface ReturnConfirmationPersistenceInterface
{
    /**
     * @return void
     */
    public function flush(): void;

    /**
     * @param \Library\Circulation\Core\ReturnConfirmation\Domain\ReturnConfirmation
     * @return void
     */
    public function save(ReturnConfirmation $model): void;

    /**
     * @param \Library\Circulation\Core\ReturnConfirmation\Domain\ReturnConfirmation
     * @return void
     */
    public function add(ReturnConfirmation $model): void;

    public function generateNextId(): ReturnConfirmationId;
}
