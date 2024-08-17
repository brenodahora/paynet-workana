<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(CreateUserRequest $request)
    {
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
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
            ], 422);
        }

        $credentials = $request->only('email', 'password');

        if (! Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Credenciais inválidas.',
            ], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('Personal Access Token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Novo usuário criado!',
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        if ($token = $request->user()->currentAccessToken()) {
            $token->delete();
        }

        return response()->json(['message' => 'Logout bem-sucedido.'], 200);
    }

    public function passwordRecovery(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'exists:users'],
        ]);

        $user = User::where('email', $data['email'])->first();
    }
}
