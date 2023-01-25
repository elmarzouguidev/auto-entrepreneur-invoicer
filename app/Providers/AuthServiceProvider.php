<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [

        'App\Models\Finance\Buy\BuyInvoice' => 'App\Policies\BuyInvoicePolicy',
        'App\Models\Finance\Buy\BuyEstimate' => 'App\Policies\BuyEstimatePolicy',

        'App\Models\Catalog\Product' => 'App\Policies\ProductPolicy',
        'App\Models\Catalog\Category' => 'App\Policies\CategoryPolicy',
        'App\Models\Catalog\Unite' => 'App\Policies\UnitePolicy',

        'App\Models\Stock\Adjustment' => 'App\Policies\AdjustmentPolicy',
        'App\Models\Stock\City' => 'App\Policies\CityPolicy',
        'App\Models\Stock\Warehouse' => 'App\Policies\WarehousePolicy',

        'App\Models\Expense\Expense' => 'App\Policies\Expense\ExpensePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Implicitly grant "Super Admin" role all permissions
        // This works in the app by using gate-related functions like auth()->user->can() and @can()
        /*Gate::before(function ($user, $ability) {
            return $user->hasRole('SuperAdmin') ? true : null;
        });*/
    }
}
