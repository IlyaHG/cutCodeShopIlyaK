<?php

namespace App\View\Composers;

use App\Models\ProductCategory;
use App\Repositories\UserRepository;
use Illuminate\View\View;

class ProductComposer
{
	public function compose(View $view): void
	{
		$product_categories = ProductCategory::all();

		$view->with('product_categories', $product_categories);
	}
}