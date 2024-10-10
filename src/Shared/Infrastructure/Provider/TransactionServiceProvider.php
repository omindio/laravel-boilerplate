<?php

namespace App\Shared\Infrastructure\Provider;

use App\Shared\Infrastructure\Persistence\EloquentTransactionManager;
use App\Shared\Application\Contract\TransactionManagerInterface;
use Illuminate\Support\ServiceProvider;

class TransactionServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(TransactionManagerInterface::class, EloquentTransactionManager::class);
    }

    public function boot(): void {}
}
