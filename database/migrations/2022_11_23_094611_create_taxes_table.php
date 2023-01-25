<?php

declare(strict_types=1);

use App\Models\Catalog\Category;
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
        Schema::create('taxes', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('name', 20);
            $table->unsignedDecimal('taux')->default(0.0)->nullable();
            $table->string('taux_percent', 20)->default('20%');
            $table->boolean('active')->default(true);
            $table->foreignIdFor(Category::class)->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('taxes');
    }
};
