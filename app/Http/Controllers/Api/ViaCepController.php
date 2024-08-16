<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ViaCepRequest;
use App\Services\ViaCep\Facades\ViaCep;

class ViaCepController extends Controller
{
    public function getAddress(ViaCepRequest $request)
    {
        $address = ViaCep::zipCode()->getAddressByZipCode($request->input('zipcode'));

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
