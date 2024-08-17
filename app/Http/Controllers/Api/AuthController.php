<?php

namespace App\Http\Controllers\Api;

use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Create new users
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

        event(new UserRegistered($user));

        $token = $user->createToken('auth_token')->plainTextToken;

        $response = [
            'success' => true,
            'message' => 'Novo usuário criado!',
            'user' => $user,
            'token' => $token,
        ];

        return response()->json($response);
    }

    // Authenticate users
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (! Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Credenciais inválidas.',
            ], 401);
        }

        $user = Auth::user();

        $token = $user->createToken('Personal Access Token')->plainTextToken;

        Auth::login($user, $remember = true);

        return response()->json([
            'success' => true,
            'message' => 'Novo usuário criado!',
            'user' => $user,
            'token' => $token,
        ]);
    }

    // Delete user token
    public function logout(Request $request)
    {
        if ($token = $request->user()->currentAccessToken()) {
            $token->delete();
        }

        return response()->json(['message' => 'Logout bem-sucedido.'], 200);
    }
}
