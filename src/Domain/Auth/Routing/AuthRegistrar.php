<?php

declare(strict_types=1);

namespace Domain\Auth\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\IndexController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class AuthRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('web')->group(function (){
            Route::controller(LoginController::class)->group(function () {

                Route::get('/login', 'page')->name('login');
                Route::post('/login-process', 'handle')
                    ->middleware('throttle:auth')
                    ->name('loginProcess');

                Route::delete('/logout', 'logout')->name('logOut');
            });

            Route::controller(RegisterController::class)->group(function () {
                Route::get('/register', 'page')->name('showRegister');
                Route::post('/register-process', 'handle')
                    ->middleware('throttle:auth')
                    ->name('registerProcess');
            });

            Route:: controller(ForgotPasswordController::class) ->group(function () {
                Route::get('/forgot-password', 'page')->middleware('guest')->name('password.request');
                Route::post('/forgot-password', 'handle')->middleware('guest')->name('password.email');
            });

            Route:: controller(ResetPasswordController::class) ->group(function () {
                Route::get('/reset-password/{token}', 'page')->middleware('guest')->name('password.reset');
                Route::post('/reset-password', 'handle')->middleware('guest')->name('password.update');
            });

            Route:: controller(SocialAuthController::class) ->group(function () {
                Route::get('/auth/socialite/{driver}', 'redirect')->middleware('guest')->name('socialite');
                Route::get('/auth/socialite/{driver}/callback', 'callback')->middleware('guest')->name('socialite.callback');
            });




        });
    }

}
