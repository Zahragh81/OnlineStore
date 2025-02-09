<?php

namespace Database\Seeders;

use App\Models\membership\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brandNames = [
            'Apple',
            'Microsoft',
            'Amazon',
            'Google',
            'Samsung',
            'Toyota',
            'Coca-Cola',
            'Mercedes-Benz',
            'BMW',
            'Louis Vuitton',
            'Cisco',
            'Nike',
            'Instagram',
            'Disney',
            'Adobe',
            'Oracle',
            'IBM',
            'SAP',
            'Facebook',
            'Hermès',
            'J.P. Morgan',
            'Starbucks',
            'Nike',
            'Spotify',
            'Uniqlo',
        ];

        foreach ($brandNames as $name) Brand::create(['name' => $name]);
    }
}
