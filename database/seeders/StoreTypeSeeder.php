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
            'مواد غذایی',
            'ارایشی و بهداشتی',
            'پوشاک',
            'الکترونیک',
            'لوازم خانگی',
            'لوازم ورزشی',
            'اسباب بازی'
        ];

        foreach ($storeTypeNames as $name) StoreType::create(['name' => $name]);
    }
}
