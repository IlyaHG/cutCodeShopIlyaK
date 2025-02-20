<?php

namespace Database\Seeders;

use Domain\Auth\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
	public function run()
	{
		$faker = Faker::create();
		for($i = 0; $i < 3; $i++) {
			User::create([
				'name' => $faker->name,
				'email' => $faker->unique()->safeEmail,
				'password' => bcrypt('password'),
			]);
		}
	}
}
