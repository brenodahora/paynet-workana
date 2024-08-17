<?php

declare(strict_types=1);

namespace App\Services\ViaCep\Endpoints;

use App\Services\ViaCep\ViaCepService;
use Illuminate\Support\Collection;

class BaseEndpoint
{
    protected ViaCepService $service;

    public function __construct()
    {
        $this->service = new ViaCepService;
    }

    protected function transform(mixed $json, $entity): Collection
    {
        return collect($json)
            ->map(fn ($object) => new $entity($object));
    }
}
