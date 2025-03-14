<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;

use Database\Factories\BrandFactory;
use Database\Factories\UserFactory;
use Domain\Auth\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
		Brand::factory(20)->create();

        Category::factory(10)->has(Product::factory(rand(5,15)))->create();
		UserFactory::new()->create();
		// $this->call([
		// 	UserSeeder::class,
		// 	ProductSeeder::class,
		// ]);
    }
}
