<?php

namespace Database\Seeders;

use App\Models\CourierType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourierTypeSeeder extends Seeder
{
    public function run(): void
    {
        $courierTypeNames = [
            'موتور',
            'سواری',
            'وانت',
            'کامیون'
        ];

        foreach ($courierTypeNames as $name) CourierType::create(['name' => $name]);
    }
}
