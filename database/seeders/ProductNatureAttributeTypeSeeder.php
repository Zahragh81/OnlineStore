<?php

namespace Database\Seeders;

use App\Models\ProductNatureAttributeType;
use Illuminate\Database\Seeder;

class ProductNatureAttributeTypeSeeder extends Seeder
{
    public function run(): void
    {
        $productNatureAttributeTypeNames = [
            'مقدار',
            'مجموعه'
        ];

        foreach ($productNatureAttributeTypeNames as $name) ProductNatureAttributeType::create(['name' => $name]);
    }
}
