<?php

declare(strict_types=1);

use App\Models\Catalog\Product;
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
        Schema::table('articles', function (Blueprint $table) {
            $table->after('taux_remise', function ($table) {
                $table->foreignIdFor(Product::class)->nullable()->constrained();
            });
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn(['product_id']);
        });
    }
};
