<?php

declare(strict_types=1);

namespace App\Services\ViaCep\Concerns;

use App\Services\ViaCep\Endpoints\ZipCodes;

trait HasZipCodes
{
    public function zipCode()
    {
        return new ZipCodes;
    }
}
