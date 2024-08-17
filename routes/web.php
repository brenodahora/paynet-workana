<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', 'home');

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
