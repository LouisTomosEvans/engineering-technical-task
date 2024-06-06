<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 50; $i++) {
            DB::table('properties')->insert([
                'name' => $faker->company,
                'address' => $faker->streetAddress,
                'town' => $faker->city,
                'county' => $faker->state,
                'postcode' => $faker->postcode,
                'image_url' => $faker->imageUrl(640, 480, 'house', true),
                'description' => $faker->paragraph,
                'rating' => $faker->numberBetween(1, 5),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
