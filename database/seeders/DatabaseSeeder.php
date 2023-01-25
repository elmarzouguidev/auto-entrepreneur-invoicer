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

        $this->call(CurrencySeeder::class);
        $this->call(ExpenseCategorySeeder::class);
        $this->call(ScheduleSeeder::class);
        $this->call(PaymentTypeSeeder::class);

        $this->call(CategorySeeder::class);
        $this->call(BrandSeeder::class);

        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);

        $this->call(AdminSeeder::class);

        $this->call(UniteSeeder::class);
        $this->call(TaxSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(WarehouseSeeder::class);

        \App\Models\Finance\Provider::factory(5)->create();
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
