<?php

namespace App\Providers;

use App\Services\ViaCep\ViaCepService;
use Illuminate\Support\ServiceProvider;

class ViaCepServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(ViaCepService::class, function ($app) {
            return new ViaCepService;
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
