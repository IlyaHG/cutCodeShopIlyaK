<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', IndexController::class, )->name('homePage');

Route::middleware('auth')->group(function () {
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logOut');
});

Route::controller(AuthController::class)->group(function () {
    // auth

    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login-process', 'login')
        ->middleware('throttle:auth')
        ->name('loginProcess');

    // register
    Route::get('/register', 'showRegister')->name('showRegister');
    Route::post('/register-process', 'register')
        ->middleware('throttle:auth')
        ->name('registerProcess');

    // forgot password
    Route::get('/forgot-password', 'showForgotPassword')->middleware('guest')->name('password.request');
    Route::post('/forgot-password', 'forgotPassword')->middleware('guest')->name('password.email');
    Route::get('/reset-password/{token}', 'showResetPassword')->middleware('guest')->name('password.reset');
    Route::post('/reset-password', 'resetPassword')->middleware('guest')->name('password.update');
    // Socialite

    Route::get('/auth/socialite/github', 'github')->middleware('guest')->name('socialite.github');
    Route::get('/auth/socialite/github/callback', 'githubCallBack')->middleware('guest')->name('socialite.github.callback');
});




