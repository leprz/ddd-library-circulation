<?php

declare(strict_types=1);

namespace Library\Circulation\Tests\Behat;

use Behat\Behat\Context\Context;
use PHPUnit\Framework\MockObject\Generator;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class BehavioralTestCase implements Context
{
    public static ContainerInterface $container;

    private static ?Generator $mockGenerator = null;

    public function __construct(
        ContainerInterface $container,
    ) {
        require_once __DIR__ . '/../../bin/.phpunit/phpunit-8.5-0/vendor/autoload.php';

        /** @noinspection PhpFieldAssignmentTypeMismatchInspection */
        self::$container = $container->has('test.service_container') ? $container->get(
            'test.service_container'
        ) : $container;

        $this->setUp();
    }

    /**
     * @template T
     * @param class-string<T> $interface The interface to resolve
     * @return T The resolved instance
     */
    protected function resolve(string $interface): object
    {
        if ($instance = self::$container->get($interface)) {
            return $instance;
        }

        throw new \LogicException(sprintf('Service [%s] does not exist.', $interface));
    }

    /**
     * @template T
     * @param class-string<T> $interface The interface to resolve
     * @return MockObject|T The resolved instance
     */
    protected function bindMock(string $interface): MockObject
    {
        $stub = $this->createMock($interface);
        $this->bindInstance($interface, $stub);
        return $stub;
    }

    protected function createMock(string $class): object
    {
        if (self::$mockGenerator === null) {
            self::$mockGenerator = new Generator();
        }

        return self::$mockGenerator->getMock($class);
    }

    /**
     * @template T
     * @param class-string<T> $id The interface to bind
     * @param object $instance
     * @return T The resolved instance
     */
    protected function bindInstance(string $id, object $instance): void
    {
        self::$container->set($id, $instance);
    }

    protected function setUp(): void
    {
    }
}
