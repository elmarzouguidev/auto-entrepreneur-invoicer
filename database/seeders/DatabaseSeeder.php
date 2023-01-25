<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->clearAll();

        $this->call(PaymentTypeSeeder::class);


        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);

        $this->call(AdminSeeder::class);

        \App\Models\Client::factory(5)->create();
    }

    private function clearAll()
    {
        Storage::disk('public')->deleteDirectory('app-files');

        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        Artisan::call('cache:clear');
        Artisan::call('optimize:clear');
    }
}
