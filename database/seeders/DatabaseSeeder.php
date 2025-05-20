<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use Database\Factories\BrandFactory;
use Database\Factories\CategoryFactory;
use Database\Factories\ProductFactory;
use Database\Factories\UserFactory;
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
		BrandFactory::new()->count(10)->create();

        CategoryFactory::new()->count(10)->create();
        ProductFactory::new()->count(10)->create();
		// $this->call([
		// 	UserSeeder::class,
		// 	ProductSeeder::class,
		// ]);
    }
}
