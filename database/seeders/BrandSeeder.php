<?php

namespace Database\Seeders;

use App\Models\Catalog\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public $brands = [
        [
            'name' => 'samsung',
            'active' => true,

        ],
        [
            'name' => 'apple',
            'active' => true,

        ],
        [
            'name' => 'HP',
            'active' => true,

        ],
    ];

    public function run()
    {
        if (Brand::count() <= 0) {
            foreach ($this->brands as $brand) {
                Brand::create($brand);
            }
        }
    }
}
