<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $cities = [
            [
                'name' => 'بیرجند',
                'parent_id' => 10
            ],
            [
                'name' => 'مشهد',
                'parent_id' => 11
            ]
        ];

        foreach ($cities as $city) City::create($city);

    }
}
