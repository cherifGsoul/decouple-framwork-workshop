<?php

namespace Todo\Infrastructure\Framework\Laravel\Provider;

use Illuminate\Support\ServiceProvider;
use Todo\Application\TodoApplicationServiceInterface;
use Todo\Application\TodoApplicationService;
use Todo\Domain\Model\Todo\TodoList;
use Todo\Infrastructure\Persistence\Capsule\EloquentTodoList;
use Todo\Domain\Model\Todo\OwnerService;
use Todo\Infrastructure\Service\TranslatingOwnerService;

class TodoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TodoApplicationServiceInterface::class, TodoApplicationService::class);
        $this->app->bind(TodoList::class, EloquentTodoList::class);
        $this->app->bind(OwnerService::class, TranslatingOwnerService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $migrationsPath = __DIR__.'/../database/migrations';
        $apiRoutesPath = __DIR__.'/../routes/api.php';

        $this->loadMigrationsFrom($migrationsPath);
        $this->loadRoutesFrom($apiRoutesPath);
    }
}
