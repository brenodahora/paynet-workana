<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ViaCepRequest;
use App\Services\ViaCep\ViaCepService;

class ViaCepController extends Controller
{
    public function __construct(public ViaCepService $viaCep) {}

    public function getAddress(ViaCepRequest $request)
    {
        $address = $this->viaCep->zipCode()->getAddressByZipCode($request->input('zipcode'));

        if ($address) {
            $response = [
                'success' => true,
                'message' => 'CEP encontrado!',
                'address' => $address->first(),
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'CEP não encontrado!',
                'address' => false,
            ];
        }

        return response()->json($response);
    }
}
