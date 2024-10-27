<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Database\Factories\BrandFactory;
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


		Product::factory(20)
		->has(Category::factory(rand(1,3)))
		->create();
		
		User::factory(2)->create();
		// $this->call([
		// 	UserSeeder::class,
		// 	ProductSeeder::class,
		// ]);
    }
}
