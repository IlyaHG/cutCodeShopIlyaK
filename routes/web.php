<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('homePage');

Route::middleware('auth')->group(function () {
	Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});




// auth

Route::get('/login-mail', [AuthController::class, 'showLoginMail'])->name('showLoginMail');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login-process', [AuthController::class, 'login'])->name('loginProcess');

// register
Route::get('/register', [AuthController::class, 'showRegister'])->name('showRegister');
Route::get('/register-mail', [AuthController::class, 'showRegisterMail'])->name('showRegisterMail');
Route::post('/register-process', [AuthController::class, 'register'])->name('registerProcess');
