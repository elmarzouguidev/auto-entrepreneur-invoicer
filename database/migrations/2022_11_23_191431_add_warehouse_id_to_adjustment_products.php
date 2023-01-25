<?php

declare(strict_types=1);

use App\Models\Stock\Warehouse;
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
        Schema::table('adjustment_products', function (Blueprint $table) {
            $table->after('uuid', function ($table) {
                $table->foreignIdFor(Warehouse::class)->nullable()->constrained();
            });
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::table('adjustment_products', function (Blueprint $table) {
            $table->dropColumn(['warehouse_id']);
        });
    }
};
