<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title'=> $this->faker->company(),
			'is_on_main_page' => $this->faker->boolean(),
			// 'thumbnail' => $this->faker->fixturesImage('products', 'images/products'),
			'sorting' => $this->faker->numberBetween(1,999)

			
        ];
    }
}
