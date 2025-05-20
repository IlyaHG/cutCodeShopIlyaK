<?php

namespace Database\Factories;

use Domain\Catalog\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Catalog\Models\Brand>
 */
class BrandFactory extends Factory
{

    protected $model = Brand::class;
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
			'thumbnail' => $this->faker->fixturesImage('brands', 'images/brands'),
			'sorting' => $this->faker->numberBetween(1,999)


        ];
    }
}
