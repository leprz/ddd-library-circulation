<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Infrastructure\CommandBus;

use Aeon\Calendar\TimeUnit;
use Aeon\Retry\DelayModifier\RetryMultiplyDelay;
use Aeon\Retry\Retry;
use Aeon\Sleep\SystemProcess;
use Doctrine\ORM\EntityManagerInterface;
use Library\Circulation\Common\Application\Retry\Exception\NoCommandsScheduledToRetryException;
use Library\Circulation\Common\Application\Retry\RetryDirectorInterface;
use Library\Circulation\Common\Application\Retry\RetryInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class CommandRetryDirector implements RetryDirectorInterface
{
    private ?RetryInterface $command = null;

    private object $handler;

    public function __construct(
        private MessageBusInterface $commandBus,
        private EntityManagerInterface $entityManager,
        private ContainerInterface $container
    ) {
    }

    public function watch(RetryInterface $command, object $handler): void
    {
        $this->command = $command;
        $this->handler = $handler;
    }

    /**
     * @throws \Aeon\Calendar\Exception\InvalidArgumentException
     * @throws \Library\Circulation\Common\Application\Retry\Exception\NoCommandsScheduledToRetryException
     * @throws \Library\Circulation\Common\Application\Retry\Exception\RetryLimitReachedException
     * @throws \Throwable
     */
    public function retry(): void
    {
        if ($this->command !== null) {
            (new Retry(
                SystemProcess::current(),
                retries: 10,
                delay: TimeUnit::milliseconds(100)
            ))
                ->modifyDelay(
                    new RetryMultiplyDelay()
                )
                ->execute(
                    function (): void {
                        if (!$this->entityManager->isOpen()) {
                            $this->container->get('doctrine')?->reset();
                        }

                        ($this->handler)($this->command);
                    }
                );
        } else {
            // TODO add route name or something
            throw new NoCommandsScheduledToRetryException('No commands scheduled to retry.');
        }
    }

    public function failed(): void
    {
        if ($this->command !== null) {
            $this->commandBus->dispatch($this->command);
        }
    }
}
