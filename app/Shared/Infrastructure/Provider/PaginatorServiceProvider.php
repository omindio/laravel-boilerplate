<?php

namespace App\Shared\Infrastructure\Provider;

use App\Shared\Infrastructure\Persistence\Eloquent\EloquentPaginator;
use App\Shared\Domain\Contract\PaginatorInterface;
use Illuminate\Support\ServiceProvider;

class PaginatorServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(PaginatorInterface::class, EloquentPaginator::class);
    }

    public function boot(): void {}
}
