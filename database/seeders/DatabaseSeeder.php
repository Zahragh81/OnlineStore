<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            GenderSeeder::class,

            CitySeeder::class,

            StoreTypeSeeder::class,
            StoreSeeder::class,

            ProductGroupTypeItemSeeder::class,

            ProductNatureAttributeItemSeeder::class,
            ProductNatureAttributeTypeSeeder::class,

            BrandSeeder::class,
        ]);
    }
}
