<?php

namespace App\Http\Requests;

use App\Rules\ValidZipCode;
use Illuminate\Foundation\Http\FormRequest;

class ViaCepRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'zipcode' => ['required', 'regex:/^[0-9]{5}-?[0-9]{3}$/', new ValidZipCode],
        ];
    }
}
