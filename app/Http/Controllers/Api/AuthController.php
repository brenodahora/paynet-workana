<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\ResetUserPasswordRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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

        Auth::login($user, $remember = true);

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

    public function passwordEmail(ResetUserPasswordRequest $request)
    {
        $response = Password::sendResetLink($request->only('email'));

        switch ($response) {
            case Password::RESET_LINK_SENT:
                return response()->json([
                    'success' => true,
                    'message' => 'Um link de redefinição de senha foi enviado para o seu e-mail.',
                ]);

            case Password::INVALID_USER:
                return response()->json([
                    'success' => false,
                    'message' => 'Nenhum usuário encontrado com esse e-mail.',
                ]);
        }
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return response()->json([
                'success' => true,
                'message' => 'Senha redefinida com sucesso!',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Falha ao definir uma nova senha.',
            ]);
        }
    }
}
