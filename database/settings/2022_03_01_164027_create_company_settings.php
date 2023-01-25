<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateCompanySettings extends SettingsMigration
{
    public function up(): void
    {
        $companyLogo = asset('images/logo-app.png');

        $this->migrator->add('company.name', 'WEDO APP');
        $this->migrator->add('company.website', 'https://wedoapp.ma');
        $this->migrator->add('company.logo', $companyLogo);
        $this->migrator->add('company.addresse', 'Technopark bureau 425 4éme etage');
        $this->migrator->add('company.telephone_a', '+212660405003');
        $this->migrator->add('company.telephone_b', '+212677512753');
        $this->migrator->add('company.email', 'info@wedoapp.ma');
        $this->migrator->add('company.rc', '507491');
        $this->migrator->add('company.ice', '002749195000015');
        $this->migrator->add('company.cnss', null);
        $this->migrator->add('company.patente', '34778172');
        $this->migrator->add('company.if', '50316039');

        $this->migrator->add('company.bank_name', 'ATTIJARI');
        $this->migrator->add('company.bank_rib', '111452365214524587452145');
    }
}
