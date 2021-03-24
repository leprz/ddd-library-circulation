<?php

declare(strict_types=1);

namespace Library\Circulation\Core\ReturnConfirmation\Application;

use Library\Circulation\Core\ReturnConfirmation\Domain\ReturnConfirmation;

/**
 * @package Library\Circulation\Common\Application\Persistence\ReturnConfirmation
 */
interface ReturnConfirmationRepositoryInterface
{
    /**
     * @return \Library\Circulation\Core\ReturnConfirmation\Domain\ReturnConfirmation
     */
    public function getById(): ReturnConfirmation;
}
