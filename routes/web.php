<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [IndexController::class,'index'])->name('homePage');	


// auth

Route::get('/login-mail', [AuthController::class,'showLoginMail'])->name('showLoginMail');
Route::get('/login', [AuthController::class,'showLogin'])->name('showLogin');
Route::post('/login-process', [AuthController::class,'login'])->name('loginProcess');



Route::get('/register', [AuthController::class,'showRegister'])->name('showRegister');
Route::get('/register-mail', [AuthController::class,'showRegisterMail'])->name('showRegisterMail');
Route::post('/register-process', [AuthController::class,'register'])->name('registerProcess');
