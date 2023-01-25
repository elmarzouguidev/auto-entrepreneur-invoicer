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
        Schema::table('estimates', function (Blueprint $table) {
            $table->after('price_total', function ($table) {
                $table->unsignedBigInteger('ht_price_remise')->default(0);
            });
        });

        Schema::table('invoices', function (Blueprint $table) {
            $table->after('price_total', function ($table) {
                $table->unsignedBigInteger('ht_price_remise')->default(0);
            });
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::table('estimates', function (Blueprint $table) {
            $table->dropColumn('ht_price_remise');
        });

        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn('ht_price_remise');
        });
    }
};
