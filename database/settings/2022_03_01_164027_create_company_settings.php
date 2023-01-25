<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateCompanySettings extends SettingsMigration
{
    public function up(): void
    {
        $companyLogo = asset('images/logo-app.png');

        $this->migrator->add('company.name', 'AUTO-ENTREPRENEUR');
        $this->migrator->add('company.website', 'https://ae.gov.ma/');
        $this->migrator->add('company.logo', $companyLogo);
        $this->migrator->add('company.addresse', 'YOUR ADRESSE');
        $this->migrator->add('company.telephone_a', '06123456789');

        $this->migrator->add('company.email', 'you@gmail.com');
        $this->migrator->add('company.rc', '5075252');
        $this->migrator->add('company.ice', '002700000000');
        $this->migrator->add('company.cnss', null);
        $this->migrator->add('company.patente', '3500000022');
        $this->migrator->add('company.if', '2121212121');

        $this->migrator->add('company.bank_name', 'CIH');
        $this->migrator->add('company.bank_rib', '111452365214524587452145');
    }
}
