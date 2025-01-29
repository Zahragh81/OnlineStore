<?php

namespace Database\Seeders;

use App\Models\membership\Store;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    public function run(): void
    {
        $stores = [
            [
                'title' => 'برجیس',
                'address' => 'مدرس 60',
                'postal_code' => '9719866876',
                'latitude' => 32.872054,
                'longitude' => 59.216274,
                'mobile' => '09155621995',
                'phone' => '05632225494',
                'owner'  => 'امیر محمدی',
                'city_id' => 1,
                'store_type_id' => 1
            ],
            [
                'title' => 'افق کوروش',
                'address' => 'پاسداران 36',
                'postal_code' => '1456833891',
                'latitude' => 32.876694,
                'longitude' => 59.220568,
                'mobile' => '09905637211',
                'phone' => '05631622275',
                'owner'  => 'فاطمه نصیری',
                'city_id' => 1,
                'store_type_id' => 1
            ],
            [
                'title' => 'اسنوا',
                'address' => 'چهار طوس',
                'postal_code' => '117675641',
                'latitude' => 32.880123,
                'longitude' => 59.214589,
                'mobile' => '09152201995',
                'phone' => '05632458237',
                'owner'  => 'هانیه احمدی',
                'city_id' => 1,
                'store_type_id' => 5
            ]
        ];

        foreach ($stores as $store) Store::create($store);
    }
}
