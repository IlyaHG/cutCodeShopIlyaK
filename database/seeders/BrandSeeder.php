<?php

namespace Database\Seeders;

use Domain\Catalog\Models\Brand;
use Illuminate\Database\Seeder;

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
