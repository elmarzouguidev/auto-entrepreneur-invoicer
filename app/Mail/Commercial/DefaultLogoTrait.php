<?php

declare(strict_types=1);

namespace App\Mail\Commercial;

use Illuminate\Support\Str;

trait DefaultLogoTrait
{
    private function getCompanyLogo()
    {
        if (Str::contains(getCompany()->logo, ['https://', 'http://'])) {
            return getCompany()->logo;
        }

        return asset('storage/'.getCompany()->logo);
    }
}
