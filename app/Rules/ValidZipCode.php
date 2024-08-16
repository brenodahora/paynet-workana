<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class ValidZipCode implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $response = Http::get("https://viacep.com.br/ws/{$value}/json/");

        // Verifica se o CEP é válido
        if ($response->status() !== 200 || isset($response->json()['erro'])) {
            $fail("O {$attribute} não é um CEP válido.");
        }
    }
}
