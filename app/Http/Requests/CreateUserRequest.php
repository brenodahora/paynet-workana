<?php

namespace App\Http\Requests;

use App\Rules\ValidZipCode;
use App\Services\ViaCep\ViaCepService;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users', 'max:255'],
            'password' => ['required', 'min:7', 'max:255'],
            'password_confirmation' => ['required', 'same:password', 'max:255'],
            'zipcode' => ['required', 'digits:8', new ValidZipCode(app(ViaCepService::class))],
            'street' => ['required', 'max:255'],
            'neighborhood' => ['required', 'max:255'],
            'number' => ['required', 'max:255'],
            'city' => ['required', 'max:255'],
            'state' => ['required', 'max:255'],
        ];
    }

    protected function prepareForValidation()
    {
        // Remove hífen do CEP
        $this->merge([
            'zipcode' => str_replace('-', '', $this->input('zipcode')),
        ]);
    }
}
