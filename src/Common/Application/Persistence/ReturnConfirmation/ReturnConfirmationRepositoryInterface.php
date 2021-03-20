<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Application\Persistence\ReturnConfirmation;

use Library\Circulation\Common\Domain\ReturnConfirmation\ReturnConfirmation;

/**
 * @package Library\Circulation\Common\Application\Persistence\ReturnConfirmation
 */
interface ReturnConfirmationRepositoryInterface
{
    /**
     * @return \Library\Circulation\Common\Domain\ReturnConfirmation\ReturnConfirmation
     */
    public function getById(): ReturnConfirmation;
}
