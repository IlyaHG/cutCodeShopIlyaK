<?php

namespace Tests\Feature\App\Http\Controllers;

use App\Http\Controllers\IndexController;
use Database\Factories\BrandFactory;
use Database\Factories\CategoryFactory;
use Database\Factories\ProductFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function it_success_response(): void
    {
        $brand = BrandFactory::new()->count(5)
            ->createOne([
                'is_on_main_page' => true,
                'sorting' => 1,
            ]);
       BrandFactory::new()->count(5)
            ->create([
                'is_on_main_page' => true,
                'sorting' => 999,
            ]);

        $category = CategoryFactory::new()->count(5)
            ->createOne([
                'is_on_main_page' => true,
                'sorting' => 1,
            ]);

        CategoryFactory::new()->count(5)
            ->create([
                'is_on_main_page' => true,
                'sorting' => 999,
            ]);



        $product = ProductFactory::new()->count(5)
            ->createOne([
                'is_on_main_page' => true,
                'sorting' => 1,
            ]);
        ProductFactory::new()->count(5)
            ->create([
                    'is_on_main_page' => true,
                    'sorting' => 999,
            ]);

        $this->get(action(IndexController::class))
            ->assertViewHas('categories.0', $category)
            ->assertViewHas('brands.0', $brand)
            ->assertViewHas('products.0', $product);
    }
}
