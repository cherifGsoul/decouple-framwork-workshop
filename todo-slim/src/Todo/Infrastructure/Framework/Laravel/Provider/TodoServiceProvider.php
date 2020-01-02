<?php

namespace Todo\Infrastructure\Provider;

use Illuminate\Support\ServiceProvider;
use Todo\Application\TodoApplicationServiceInterface;
use Todo\Application\TodoApplicationService;

class TodoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app()->bind(TodoApplicationServiceInterface::class, TodoApplicationService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
