<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Utilities\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        $currencies = [

            ['name' => 'Dirham Maroccan', 'symbole' => 'DH', 'default' => true],

        ];

        foreach ($currencies as $currency) {
            Currency::create($currency);
        }
    }
}
