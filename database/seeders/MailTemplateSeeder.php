<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Tools\MailTemplates;
use Illuminate\Database\Seeder;

class MailTemplateSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        $contents = file_get_contents(resource_path('views/theme/Emails/Commercial/Estimate/SendEstimateMail.blade.php'));
        MailTemplates::create([
            'name' => 'DEVIS-EMAIL',
            'content' => $contents,
        ]);
    }
}
