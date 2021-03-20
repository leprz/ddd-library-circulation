<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Application\Persistence\ReturnConfirmation;

use Library\Circulation\Common\Domain\ReturnConfirmation\ReturnConfirmation;
use Library\Circulation\Common\Domain\ReturnConfirmation\ReturnConfirmationId;

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
     * @param \Library\Circulation\Common\Domain\ReturnConfirmation\ReturnConfirmation
     * @return void
     */
    public function save(ReturnConfirmation $model): void;

    /**
     * @param \Library\Circulation\Common\Domain\ReturnConfirmation\ReturnConfirmation
     * @return void
     */
    public function add(ReturnConfirmation $model): void;

    public function generateNextId(): ReturnConfirmationId;
}
