<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AddRoleDevelopperToAdmin extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        $admin = User::whereEmail('abdelgha4or@gmail.com')->first();

        if ($admin) {
            $admin->assignRole('Developper');
        }
    }
}
