<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'login');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/logout', function () {
    return view('auth.login');
})->name('logout');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/home', function () {
    return view('home');
})->name('home');


