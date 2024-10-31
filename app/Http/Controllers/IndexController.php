<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Services\Telegram\Exceptions\TelegramBotApiException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class IndexController extends Controller
{
    public function __invoke(): Factory|View|Application
	{

		$categories = Category::query()->homePage()->get();
		$products = Product::query()->homePage()->get();
        dd($products);
		$brands = Brand::query()->homePage()->get();

		return view("index",compact(
			'categories',
			'products',
			'brands'));
	}
}
