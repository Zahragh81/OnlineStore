<?php

namespace Database\Seeders;

use App\Models\membership\StoreType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
