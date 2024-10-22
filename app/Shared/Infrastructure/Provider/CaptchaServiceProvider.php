<?php

namespace App\Shared\Infrastructure\Provider;

use App\Shared\Domain\Contract\CaptchaInterface;
use Illuminate\Support\ServiceProvider;
use App\Shared\Infrastructure\Service\HCaptchaService;

class CaptchaServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(CaptchaInterface::class, HCaptchaService::class);
    }
}
