<?php

declare(strict_types=1);

namespace PHPSTORM_META;

use Doctrine\ORM\EntityManagerInterface;
use Library\Circulation\Tests\KernelTestCase;

// Make the service resolver return the same type as the input parameter
override(KernelTestCase::resolve(), type(0));
override(KernelTestCase::bindStub(), type(0));
override(KernelTestCase::bindMock(), type(0));
override(EntityManagerInterface::getReference(), type(0));
