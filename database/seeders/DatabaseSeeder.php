<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            GenderSeeder::class,

            ProvinceSeeder::class,
            CitySeeder::class,

            StoreTypeSeeder::class,
            StoreSeeder::class,

            ProductGroupTypeItemSeeder::class,

            ProductNatureAttributeItemSeeder::class,
            ProductNatureAttributeTypeSeeder::class,

            BrandSeeder::class,

            OrderStatusSeeder::class,

            OrderItemStatusSeeder::class,

            CourierTypeSeeder::class,

            PaymentMethodSeeder::class

        ]);
    }
}
