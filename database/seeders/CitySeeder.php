<?php

namespace Database\Seeders;

use App\Models\membership\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
