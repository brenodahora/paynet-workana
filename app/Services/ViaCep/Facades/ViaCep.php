<?php

declare(strict_types=1);

namespace App\Services\ViaCep\Facades;

use App\Services\ViaCep\ViaCepService;
use Illuminate\Support\Facades\Facade;

class ViaCep extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ViaCepService::class;
    }
}
