<?php

declare(strict_types=1);

namespace App\Services\ViaCep;

use App\Services\ViaCep\Concerns\HasZipCodes;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

/**
 * ViaCep Service API
 */
class ViaCepService
{
    use HasZipCodes;

    public PendingRequest $http;

    public function __construct()
    {
        $this->http = Http::timeout(30)
            ->baseUrl('https://viacep.com.br/ws/')
            ->acceptJson();
    }
}
