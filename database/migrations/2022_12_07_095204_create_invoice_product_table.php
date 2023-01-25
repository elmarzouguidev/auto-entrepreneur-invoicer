<?php

declare(strict_types=1);

use App\Models\Catalog\Product;
use App\Models\Finance\Invoice;
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
        Schema::create('invoice_product', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Invoice::class)->constrained();
            $table->foreignIdFor(Product::class)->constrained();
            $table->timestamps();
            $table->index(['product_id', 'invoice_id']);
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_product');
    }
};
