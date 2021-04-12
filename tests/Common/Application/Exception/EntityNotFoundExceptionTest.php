<?php

declare(strict_types=1);

namespace Library\Circulation\Tests\Common\Application\Exception;

use Library\Circulation\Common\Application\Exception\EntityNotFoundException;
use Library\Circulation\Tests\IsolatedTestCase;

class EntityNotFoundExceptionTest extends IsolatedTestCase
{
    /**
     * @test
     */
    public function nice_message_is_created(): void
    {
        $exception = EntityNotFoundException::identifiedBy('Some\Test\CoolFrenchKey', '50be1b8f-5b58-4a1e-9df1-24832366e21b');
        self::assertSame(
            'Entity [cool french key:50be1b8f-5b58-4a1e-9df1-24832366e21b] not found.',
            $exception->getMessage()
        );
    }
}
