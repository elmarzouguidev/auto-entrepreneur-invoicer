<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Catalog\Unite;
use Illuminate\Database\Seeder;

class UniteSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        $unites = [
            ['name' => 'Kilo', 'symbole' => 'KG'],
            ['name' => 'mètre', 'symbole' => 'M'],
            ['name' => 'Lettre', 'symbole' => 'L'],
            ['name' => 'pièce', 'symbole' => 'UT'],
        ];

        foreach ($unites as $un) {
            Unite::create($un);
        }
    }
}
