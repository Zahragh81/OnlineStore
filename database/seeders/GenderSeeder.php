<?php

namespace Database\Seeders;

use App\Models\membership\Gender;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    public function run(): void
    {
        $GenderNames = [
            'مرد',
            'زن'
        ];

        foreach ($GenderNames as $name) Gender::create(['name' => $name]);
    }
}
