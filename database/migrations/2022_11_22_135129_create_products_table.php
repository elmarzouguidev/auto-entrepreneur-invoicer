<?php

declare(strict_types=1);

use App\Models\Catalog\Brand;
use App\Models\Catalog\Category;
use App\Models\Catalog\Unite;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');

            $table->foreignIdFor(Category::class)->index()->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Brand::class)->index()->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Unite::class)->index()->nullable()->constrained()->nullOnDelete();

            $table->string('name');
            $table->longText('description')->nullable();

            $table->unsignedBigInteger('qte')->default(0)->nullable();

            $table->unsignedDecimal('price_brut')->default(0)->nullable();
            $table->unsignedDecimal('price_net')->default(0)->nullable();

            $table->unsignedDecimal('price_buy')->default(0)->nullable();
            $table->unsignedDecimal('price_sell')->default(0)->nullable();
            $table->unsignedDecimal('price_tax')->default(0)->nullable(); // only tax
            $table->unsignedDecimal('price_sell_total')->default(0)->nullable(); // tax include

            $table->string('sku')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
