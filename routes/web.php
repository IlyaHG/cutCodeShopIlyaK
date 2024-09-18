<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class,)->name('homePage');

Route::middleware('auth')->group(function () {
	Route::delete('/logout', [AuthController::class, 'logout'])->name('logOut');
});

Route::controller(AuthController::class)->group(function () {
		// auth

		Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
		Route::post('/login-process', [AuthController::class, 'login'])->name('loginProcess');
	
		// register
		Route::get('/register', [AuthController::class, 'showRegister'])->name('showRegister');
		Route::post('/register-process', [AuthController::class, 'register'])->name('registerProcess');
	
		// forgot password 
		Route::get('/forgot-password', [AuthController::class,'showForgotPassword'])->name('showForgotPassword');
		Route::post('/forgot-password',[AuthController::class,'forgotPasswordProcess'])->name('password.email');
	
});


