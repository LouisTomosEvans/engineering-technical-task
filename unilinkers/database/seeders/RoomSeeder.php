<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        // Get all property IDs to associate rooms with properties
        $propertyIds = DB::table('properties')->pluck('id');

        foreach ($propertyIds as $propertyId) {
            // Generate a random number of rooms for each property
            $numberOfRooms = $faker->numberBetween(1, 10);

            for ($i = 0; $i < $numberOfRooms; $i++) {
                DB::table('rooms')->insert([
                    'name' => 'Room ' . ($i + 1),
                    'description' => $faker->paragraph,
                    'property_id' => $propertyId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
