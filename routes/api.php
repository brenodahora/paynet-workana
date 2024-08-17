<?php

use App\Http\Controllers\Api\ViaCepController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    if ($request->user()) {
        return response()->json(['authenticated' => true], 200);
    }
    
    return response()->json(['authenticated' => false], 401);
})->name('api.user')->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register'])->name('api.register');

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::post('/viacep', [ViaCepController::class, 'getAddress'])->name('api.viacep');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', [UserController::class, 'getAll'])->name('api.users');
    Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');
});