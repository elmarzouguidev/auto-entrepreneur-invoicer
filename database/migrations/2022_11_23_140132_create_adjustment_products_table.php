<?php

declare(strict_types=1);

use App\Models\Catalog\Product;
use App\Models\Stock\Adjustment;
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
        Schema::create('adjustment_products', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->foreignIdFor(Adjustment::class)->constrained();
            $table->foreignIdFor(Product::class)->constrained();
            $table->unsignedBigInteger('qte')->default(0);
            $table->string('type', 30)->default('add');
            $table->date('date')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('adjustment_products');
    }
};
