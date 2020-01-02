<?php

namespace Todo\Infrastructure\Service;

use Illuminate\Auth\AuthManager;

class LaravelUserAdapter implements UserAdapter
{
    private $authManager;

    public function __construct(AuthManager $authManager)
    {
        $this->authManager = $authManager;
    }
}
