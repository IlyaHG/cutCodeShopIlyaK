<?php

namespace App\Providers;

use Support\Testing\FakerImageProvider;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Support\ServiceProvider;

class TestingServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton(Generator::class, function () {
            $faker = Factory::create();
            $faker->addProvider(new FakerImageProvider($faker));

            return $faker;
        });
	}

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{

	}
}
