<?php

declare(strict_types=1);

namespace Library\Circulation\Tests;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\MockObject\Stub;

class KernelTestCase extends \Symfony\Bundle\FrameworkBundle\Test\KernelTestCase
{
    /**
     * @template T
     * @param class-string<T> $interface The interface to resolve
     * @return T The resolved instance
     */
    protected function resolve(string $interface): object
    {
        if (!self::$booted) {
            self::bootKernel();
        }

        if ($instance = self::$container->get($interface)) {
            return $instance;
        }

        throw new \LogicException(sprintf('Service [%s] does not exist.', $interface));
    }

    /**
     * @template T
     * @param class-string<T> $interface The interface to resolve
     * @return T The resolved instance
     */
    protected function bindStub(string $interface): Stub
    {
        $stub = $this->createStub($interface);
        $this->bindInstance($interface, $stub);
        return $stub;
    }

    /**
     * @template T
     * @param class-string<T> $interface The interface to resolve
     * @return T The resolved instance
     */
    protected function bindMock(string $interface): MockObject
    {
        $stub = $this->createStub($interface);
        $this->bindInstance($interface, $stub);
        return $stub;
    }

    protected function bindInstance(string $id, object $stub): void
    {
        if (!self::$booted) {
            self::bootKernel();
        }

        self::$container->set($id, $stub);
    }
}
