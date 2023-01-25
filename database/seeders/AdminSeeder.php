<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'nom' => 'Elmarzougui',
            'prenom' => 'Abdelghafour',
            'telephone' => '0677512753',
            'email' => 'abdelgha4or@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789@'),
            'remember_token' => Str::random(10),
            'super_admin' => true,
        ];

        $user2 = [
            'nom' => 'BOUANI',
            'prenom' => 'DOUNIA',
            'telephone' => '0620772936',
            'email' => 'dounia.bouani20@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('wedo2023'),
            'remember_token' => Str::random(10),
            'super_admin' => true,
        ];

        $user3 = [
            'nom' => 'HARIT',
            'prenom' => 'Yassine',
            'telephone' => '0625238402',
            'email' => 'harityassine9@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789@'),
            'remember_token' => Str::random(10),
            'super_admin' => true,
        ];

        $admin = User::whereEmail('abdelgha4or@gmail.com')->first();
        $admin2 = User::whereEmail('dounia.bouani20@gmail.com')->first();
        $admin3 = User::whereEmail('harityassine9@gmail.com')->first();

        if (!$admin && !$admin2 && !$admin3) {
            $newAdmin = User::create($user);
            $newAdmin->assignRole('SuperAdmin', 'Developper');

            $newAdmin2 = User::create($user2);
            $newAdmin2->assignRole('SuperAdmin');

            $newAdmin3 = User::create($user3);
            $newAdmin3->assignRole('SuperAdmin');
        } else {
            $admin->assignRole('SuperAdmin', 'Developper');
            $admin2->assignRole('SuperAdmin');
            $admin3->assignRole('SuperAdmin');
        }
    }
}
