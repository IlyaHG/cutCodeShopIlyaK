<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$category_list = [
			'Мыши',
			'Клавиатуры',
			'Наушники',
			'Поверхности',
			'Мониторы',
			'Геймпады',
			'Консоли',
			'Акустика',
			'Аксессуары',
			'Распродажа',
		];
		$faker = Faker::create();
		foreach ($category_list as $category_name) {
			$category = Category::create(['title' => $category_name]);

			    // Создаем 5 товаров для каждой категории
				for ($i = 0; $i < 5; $i++) {
					Product::create([
						'title' => $faker->name(), // Предположим, что у вас есть метод генерации имени продукта
						'description' => $faker->text(), // Описание товара
						'short_description' => $faker->text(), // Описание товара
						'price' => $faker->randomFloat(2, 1000, 100000), // Цена товара
						'category_id' => $category->id, // ID категории
					]);
				}
		}
		echo ('Категории товаров успешно добавлены');
	}
}
