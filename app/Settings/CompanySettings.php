<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class CompanySettings extends Settings
{
    public string $name;

    public string $website;

    public string $logo;

    public string $addresse;

    public string $telephone_a;

    public string $email;

    public ?string $rc;

    public string $ice;

    public ?string $cnss;

    public ?string $patente;

    public ?string $if;

    public ?string $bank_name;

    public ?string $bank_rib;

    public static function group(): string
    {
        return 'company';
    }
}
