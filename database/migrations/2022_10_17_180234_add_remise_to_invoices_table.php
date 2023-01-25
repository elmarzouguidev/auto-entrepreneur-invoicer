<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * @return void
     */
    public function up(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->after('remise', function ($table) {
                $table->boolean('remise_fix')->default(false);
            });
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn(['remise_fix']);
        });
    }
};
