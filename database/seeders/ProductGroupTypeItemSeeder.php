<?php

namespace Database\Seeders;

use App\Models\membership\ProductGroupTypeItem;
use Illuminate\Database\Seeder;

class ProductGroupTypeItemSeeder extends Seeder
{
    public function run(): void
    {
        $productGroupTypeItemNames = [
            'مردانه',
            'زنانه',
            'دخترانه',
            'پسرانه',
            'بهاره',
            'تابستانه',
            'پاییزه',
            'زمستانه',
            'کت',
            'کت شلوار',
            'شلوار',
            'پیراهن'
        ];

        foreach ($productGroupTypeItemNames as $name) ProductGroupTypeItem::create(['name' => $name]);
    }
}
