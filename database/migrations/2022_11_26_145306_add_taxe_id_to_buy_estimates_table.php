<?php

declare(strict_types=1);

use App\Models\Utilities\Tax;
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
        Schema::table('buy_estimates', function (Blueprint $table) {
            $table->after('provider_id', function ($table) {
                $table->foreignIdFor(Tax::class)
                    ->nullable()
                    ->constrained();
            });
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::table('buy_estimates', function (Blueprint $table) {
            $table->dropColumn('tax_id');
        });
    }
};
