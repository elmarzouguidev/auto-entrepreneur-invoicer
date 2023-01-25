<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Stock\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        $cities = [

            ['name' => 'Casablanca'],
            ['name' => 'Mohammadia'],
            ['name' => 'Rabat'],

        ];

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}
