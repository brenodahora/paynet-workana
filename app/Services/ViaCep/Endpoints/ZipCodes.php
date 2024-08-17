<?php

declare(strict_types=1);

namespace App\Services\ViaCep\Endpoints;

use App\Services\ViaCep\Entities\ZipCode;
use Illuminate\Support\Collection;

class ZipCodes extends BaseEndpoint
{
    // Get address by zipcode
    public function getAddressByZipCode(string $zipCode): Collection|bool
    {
        $response = $this->service->http->get($zipCode.'/json');

        if ($response->successful()) {
            return $this->transform(
                [
                    $response->json(),
                ],
                ZipCode::class
            );
        } else {
            return false;
        }
    }
}
