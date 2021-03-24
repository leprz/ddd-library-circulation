<?php

declare(strict_types=1);

// https://github.com/FriendsOfBehat/SymfonyExtension/issues/126
(new Symfony\Component\Dotenv\Dotenv())->bootEnv(__DIR__ . '/../../.env');
