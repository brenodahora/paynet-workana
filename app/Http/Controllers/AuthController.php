<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\ValidZipCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:7'],
            'password_confirm' => ['required', 'same:password'],
            'zipcode' => ['required', 'size:8', new ValidZipCode()],
            'street' => ['required'],
            'neighborhood' => ['required'],
            'number' => ['required'],
            'city' => ['required'],
            'state' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Falha na validação dos dados.',
                'errors' => $validator->errors(),
            ]);
        }

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'zipcode' => $request->input('zipcode'),
            'street' => $request->input('street'),
            'neighborhood' => $request->input('neighborhood'),
            'number' => $request->input('number'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        $response = [
            'success' => true,
            'message' => 'Novo usuário criado!',
            'user' => $user,
            'token' => $token,
        ];

        return response()->json($response);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'exists:users'],
            'password' => ['required', 'min:7'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Falha na validação dos dados.',
                'errors' => $validator->errors(),
            ]);
        }

        $user = User::where('email', $request->input('email'))->first();

        if (! $user || ! Hash::check($request->input('password'), $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Usuário informado não existe ou senha incorreta.',
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => false,
            'message' => 'Login efetuado!',
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function passwordRecovery(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'exists:users'],
        ]);

        $user = User::where('email', $data['email'])->first();
    }
}
