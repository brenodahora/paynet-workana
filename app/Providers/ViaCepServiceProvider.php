<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViaCepServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    public function zipcodeIsValid(int $zipcode): bool
    {

        return false;
    }
}
