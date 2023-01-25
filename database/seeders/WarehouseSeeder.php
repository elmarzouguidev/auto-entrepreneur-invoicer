<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Stock\Warehouse;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        $warehouses = [

            ['name' => 'AIN CHOK', 'address' => 'casablanca ain chok', 'city_id' => 1, 'user_id' => 1],
            ['name' => 'DERB SULTAN', 'address' => 'casablanca derb sultan', 'city_id' => 1, 'user_id' => 1],
        ];

        foreach ($warehouses as $warehouse) {
            Warehouse::create($warehouse);
        }
    }
}
