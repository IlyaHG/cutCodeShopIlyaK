<?php

namespace App\Providers;

use App\View\Composers\AppComposer;
use App\View\Composers\ProductComposer;
use Illuminate\Support\ServiceProvider;
use View;

class ViewServiceProvider extends ServiceProvider
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
		View::composer(['*'], ProductComposer::class);
	}
}
