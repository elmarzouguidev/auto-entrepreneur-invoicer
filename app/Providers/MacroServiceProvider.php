<?php

namespace App\Providers;

use App\Macros\RequestMixin;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Request::mixin(new RequestMixin());
    }
}
