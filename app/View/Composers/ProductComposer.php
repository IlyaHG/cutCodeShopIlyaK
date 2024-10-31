<?php

namespace App\View\Composers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Repositories\UserRepository;
use Illuminate\View\View;

class ProductComposer
{
	public function compose(View $view): void
	{
		$product_categories = Category::where('is_on_main_page', 1)->get();

		$products = Product::all()->sortBy('id')->take(8);
		$brands = Brand::all()->take(6);


		$view->with('product_categories', $product_categories);
		$view->with('products', $products);
		$view->with('brands', $brands);
	}
}