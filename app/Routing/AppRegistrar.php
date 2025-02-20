<?php

declare(strict_types=1);

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\IndexController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class AppRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {

        Route::middleware('web')->group(function () {
            Route::get('/', IndexController::class)->name('homePage');

            Route::get('/storage/images/{dir}/{method}/{size}/{file}')
                ->where('method', 'resize|crop|fit')
                ->where('size', '\d+x\d+')
                ->where('file', '.+\.(jpg|jpeg|png|gif|bmp)$')
                ->name('thumbnail');
        });
    }

}
