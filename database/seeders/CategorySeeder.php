<?php

namespace Database\Seeders;

use App\Models\Catalog\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public $cates = [
        [
            'name' => 'category 1',
            'active' => true,

        ],
        [
            'name' => 'category 2',
            'active' => false,

        ],
    ];

    public function run()
    {
        if (Category::count() <= 0) {
            foreach ($this->cates as $category) {
                Category::create($category);
            }
        }
    }
}
