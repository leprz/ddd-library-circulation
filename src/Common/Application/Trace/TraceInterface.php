<?php

declare(strict_types=1);

namespace Library\Circulation\Common\Application\Trace;

interface TraceInterface
{
    public function getRequestId(): RequestId;
}
