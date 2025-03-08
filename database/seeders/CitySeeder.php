<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $cityNames = [
            'بیرجند'
        ];

        foreach ($cityNames as $name) City::create(['name' => $name]);
    }
}
