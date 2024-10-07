<?php

namespace App\Presentation\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;

class PresentationServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        //TODO: Donde añadir esto? en application o infrastructure o presentation
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(30)->by($request->user()?->id ?: $request->ip());
        });
    }
}
