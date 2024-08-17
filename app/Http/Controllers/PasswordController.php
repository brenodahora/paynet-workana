<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetUserPasswordRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Mail\PasswordResetNotification;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class PasswordController
{
    // Send password email reset to user
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

    // Update user password
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();

                Mail::to($user->email)->send(new PasswordResetNotification($user));

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
