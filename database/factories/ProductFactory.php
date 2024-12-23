<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
			'title' => ucfirst($this->faker->words(2,true)),
            'thumbnail'=> $this->faker->fixturesImage('products','/images/products'),
            'brand_id' => Brand::query()->inRandomOrder()->value('id'),
			'price'=> $this->faker->numberBetween(1000,100000),
			'is_on_main_page' => $this->faker->boolean(),
			'sorting' => $this->faker->numberBetween(1,999)
        ];
    }
}
