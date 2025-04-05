<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    public function run(): void
    {
        $orderStatusNames = [
            'در حال بررسی',
            'در دست اقدام',
            'پایان یافته',
            'لغو شده'
        ];

        foreach ($orderStatusNames as $name) OrderStatus::create(['name' => $name]);
    }
}
