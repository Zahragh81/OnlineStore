<?php

namespace Database\Seeders;

use App\Models\membership\ProductNatureAttributeItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductNatureAttributeItemSeeder extends Seeder
{
    public function run(): void
    {
        $productNatureAttributeItemNames = [
            'سفید',
            'نقره ای',
            'سیاه',
            'ابی',
            'هشت فوت مکعب',
            'ده فوت مکعب',
            'دوازده فوت مکعب',
            'چهارده فوت مکعب',
            'یخ ساز خودکار',
            'صفحه نمایش لمسی',
            'طبقات قابل تنظیم',
            'سیستم ضد بو',
            'درب بالایی فریزر',
            'درب پایینی فریزر',
            'دو درب',
            'چهار درب',
            'A++ کلاس انرژی',
            'A+ کلاس انرژی',
        ];

        foreach ($productNatureAttributeItemNames as $name) ProductNatureAttributeItem::create(['name' => $name]);
    }
}
