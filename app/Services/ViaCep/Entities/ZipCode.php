<?php

declare(strict_types=1);

namespace App\Services\ViaCep\Entities;

class ZipCode
{
    public ?string $zipCode;

    public ?string $street;

    public ?string $neighborhood;

    public ?string $city;

    public ?string $state;

    public function __construct(array $data)
    {
        $this->zipCode = data_get($data, 'cep');
        $this->street = data_get($data, 'logradouro');
        $this->neighborhood = data_get($data, 'bairro');
        $this->city = data_get($data, 'localidade');
        $this->state = data_get($data, 'uf');
    }
}
