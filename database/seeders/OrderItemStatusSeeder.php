<?php

namespace Database\Seeders;

use App\Models\OrderItemStatus;
use Illuminate\Database\Seeder;

class OrderItemStatusSeeder extends Seeder
{
    public function run(): void
    {
        $orderItemStatusNames = [
            'در حال آماده سازی',
            'تایید شده',
            'لغو شده'
        ];

        foreach ($orderItemStatusNames as $name) OrderItemStatus::create(['name' => $name]);
    }
}
