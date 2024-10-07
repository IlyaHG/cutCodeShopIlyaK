<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_that_products_from_bd_on_home_page()
    {
		$category = Category::create(['title'=>'test_category']);
		$test_product = Product::create([
			'title'=>'test_title',
			'category_id'=>$category->id,
		]);
        $response = $this->get('/');
		$response->assertSee($test_product->title);
        $response->assertStatus(200);
    }

	public function test_that_brands_from_bd_can_see_on_home_page()
    {
		$test_brand = Brand::create([
			'title'=>'test_title',
		]);
        $response = $this->get('/');
		$response->assertSee($test_brand->title);
        $response->assertStatus(200);
    }
	public function test_that_categories_from_bd_can_see_on_home_page()
    {
		$test_category = Category::create([
			'title'=>'test_title',
		]);
        $response = $this->get('/');
		$response->assertSee($test_category->title);
        $response->assertStatus(200);
    }
}
