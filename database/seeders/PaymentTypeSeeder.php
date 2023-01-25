<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Utilities\PaymentType;
use Illuminate\Database\Seeder;

class PaymentTypeSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        $types = [

            ['name' => 'Espèces'],
            ['name' => 'Virement'],
            ['name' => 'Chèque'],
            ['name' => 'Carte bancaire'],
            ['name' => 'Lettre de change'],
            ['name' => 'Prélèvement'],
            ['name' => 'Virement bancaire'],
            ['name' => 'Effet'],

        ];

        foreach ($types as $type) {
            PaymentType::create($type);
        }
    }
}
