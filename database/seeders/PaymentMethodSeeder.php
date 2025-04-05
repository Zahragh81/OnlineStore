<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    public function run(): void
    {
        $paymentMethodNames = [
            'درگاه پرداخت الکترونیک',
            'پرداخت در محل(pos - نقدی)',
            'اعتباری'
        ];

        foreach ($paymentMethodNames as $name) PaymentMethod::create(['name' => $name]);
    }
}
