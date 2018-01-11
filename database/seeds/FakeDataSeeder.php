<?php

use App\Models\Merchant;
use Illuminate\Database\Seeder;

class FakeDataSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$faker = Faker\Factory::create();
		for ($i = 0; $i < 30; $i++) {
			Merchant::create([
				'name' => $faker->name,
				'image' => 'http://lorempixel.com/400/200/',
				'address' => $faker->address,
				'telp' => $faker->phoneNumber,
				'owner' => $faker->name,
				'latitude' => $faker->latitude,
				'longitude' => $faker->longitude,
				'type' => 'Test',
			]);
		}
	}
}
