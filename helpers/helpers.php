<?php

use App\Settings\CompanySettings;
use App\Settings\DocumentSettings;
use Illuminate\Support\Str;

if (! function_exists('getDocument')) {
    function getDocument(): DocumentSettings
    {
        return app(DocumentSettings::class);
    }
}

if (! function_exists('getCompany')) {
    function getCompany(): CompanySettings
    {
        return app(CompanySettings::class);
    }
}

if (! function_exists('getDocument')) {
    function getImagePath()
    {
        return asset('storage/').'/';
    }
}

if (! function_exists('loadSetting')) {
    function loadSetting($abstract)
    {
        return app('App\Settings\\'.$abstract.'Settings');
    }
}

if (! function_exists('getDomainName')) {
    function getDomainName()
    {
        return request()->getSchemeAndHttpHost().'/';
    }
}

if (! function_exists('appLogo')) {
    function appLogo()
    {
        if (Str::contains(getCompany()->logo, ['https://', 'http://'])) {
            return getCompany()->logo;
        }

        return asset('storage/'.getCompany()->logo);
    }
}

/*****Auth guard helpers *****/

if (! function_exists('isAdmin')) {
    function isAdmin()
    {
        return auth()->check() && auth()->user()->hasRole('SuperAdmin') ? true : false;
    }
}

/*****Date Helpers */

if (! function_exists('getNow')) {
    function getNow()
    {
        return now()->format('Y-m-d');
    }
}

/******************* */
