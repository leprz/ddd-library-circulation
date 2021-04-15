<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Infrastructure\CommandBus;

use Doctrine\DBAL\ConnectionException;
use Doctrine\DBAL\Exception\RetryableException;
use Library\Circulation\Common\Application\Retry\Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class OnKernelException
{
    public function __construct(private CommandRetryDirector $retryDirector, private LoggerInterface $logger)
    {
    }

    /**
     * @throws \Exception
     * @throws \Throwable
     */
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if (
            $exception instanceof RetryableException ||
            $exception instanceof ConnectionException
        ) {
            try {
                // TODO notify user that something may take longer than expected
                $this->retryDirector->retry();
                $this->convertToSuccessfulResponse($event);
            } catch (Exception\NoCommandsScheduledToRetryException $e) {
                $this->logger->warning($e->getMessage());
            } catch (\Throwable $e) {
                $this->retryDirector->failed();
                $this->logger->error($e->getMessage());
            }
        }
    }

    private function convertToSuccessfulResponse(ExceptionEvent $event): void
    {
        $event->allowCustomResponseCode();
        $event->setResponse(new JsonResponse(null, 200));
        $event->stopPropagation();
    }
}
