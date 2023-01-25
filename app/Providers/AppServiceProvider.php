<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale(config('app.locale'));

        Schema::defaultStringLength(125); // On MySQL 8.0 use defaultStringLength(125)
        //  Schema::defaultStringLength(191);

        // Schema::enableForeignKeyConstraints();

        if (! app()->runningInConsole()) {
            Schema::disableForeignKeyConstraints();
        }

        //Paginator::defaultView('vendor.pagination.bootstrap');
    }
}
