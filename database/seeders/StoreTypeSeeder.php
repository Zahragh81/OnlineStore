<?php

namespace Database\Seeders;

use App\Models\StoreType;
use Illuminate\Database\Seeder;

class StoreTypeSeeder extends Seeder
{
    public function run(): void
    {
        $storeTypeNames = [
            'سوپر مارکت',
            'پوشاک',
            'موبایل',
            'لوازم خانگی'
        ];
        foreach ($storeTypeNames as $name) StoreType::create(['name' => $name]);
    }
}
