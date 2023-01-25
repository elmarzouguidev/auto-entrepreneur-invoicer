<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Schedule\Schedule;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        $schedules = [

            ['name' => 'Semaine', 'number' => 7],
            ['name' => '2 Semaines', 'number' => 14],
            ['name' => '1 Mois', 'number' => 30],
            ['name' => '2 Mois', 'number' => 60],
            ['name' => '3 Mois', 'number' => 90],
            ['name' => '6 Mois', 'number' => 120],
            ['name' => '1 Année', 'number' => 365],

        ];

        foreach ($schedules as $schedule) {
            Schedule::create($schedule);
        }
    }
}
