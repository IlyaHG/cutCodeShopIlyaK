<?php

namespace App\Providers;

use Carbon\CarbonInterface;
use Carbon\CarbonInterval;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Connection;
use Illuminate\Support\Facades\DB;
use App\Http\Kernel;
use Illuminate\Validation\Password\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Model::shouldBeStrict(!app()->isProduction());

        if (app()->isProduction()) {
            DB::whenQueryingForLongerThan(500, function (Connection $connection) {
                logger()->channel("telegram")->debug('whenQueryingForLongerThan:' . $connection->query()->toSql());
            });


            DB::listen(function ($query) {
                if ($query->time > 1.1) {
                    logger()->channel("telegram")->debug('listen:' . $query->sql, $query->bindings);

                }
            });

            $kernel = app(Kernel::class);

            $kernel->whenRequestLifecycleIsLongerThan(
                CarbonInterval::seconds(4),
                function () {
                    logger()->channel("telegram")->debug('whenRequestLifecycleIsLongerThan:' . request()->url());

                }
            );
        }

        Password::defaults(function (){
            return Password::min('8');
        });


    }
}
