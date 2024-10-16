<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BrandSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$brand_list = [
			'SteelSeries',
			'Razor',
			'Logitech',
			'HyperX',
			'PlayStation',
			'Xbox',
			'Microsoft',
			'Intel',
			'AMD',
		];
		
		foreach($brand_list as $brand_name) {
			Brand::create([
				'title'=> $brand_name,
			]);
		}

		echo ('Бренды товаров успешно добавлены');
	}
}
