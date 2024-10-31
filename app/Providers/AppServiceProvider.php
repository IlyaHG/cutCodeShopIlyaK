<?php

namespace App\Providers;

use Carbon\CarbonInterface;
use Carbon\CarbonInterval;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Connection;
use Illuminate\Support\Facades\DB;
use App\Http\Kernel;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Model::shouldBeStrict(!app()->isProduction());

        if (app()->isProduction()) {
            DB::listen(static function ($query) {
                if ($query->time > 100) {
                    logger()
                        ->channel("telegram")
                        ->debug('query longer than 1ms:' . $query->sql, $query->bindings);
                }
            });

            app(Kernel::class)->whenRequestLifecycleIsLongerThan(
                CarbonInterval::seconds(4),
                function () {
                    logger()->channel("telegram")->debug('whenRequestLifecycleIsLongerThan:' . request()->url());

                }
            );
        }
    }
}
