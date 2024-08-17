<?php

namespace App\Rules;

use App\Services\ViaCep\ViaCepService;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidZipCode implements ValidationRule
{
    public function __construct(protected ViaCepService $viaCepService) {}

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $response = $this->viaCepService->zipCode()->getAddressByZipCode($value);

        if (! $response) {
            $fail("O {$attribute} não é um CEP válido.");
        }
    }
}
