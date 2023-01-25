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
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->nullable();
            $table->string('code')->unique()->nullable();

            $table->string('name')->unique();
            $table->mediumText('description')->nullable();
            $table->string('logo')->nullable();

            $table->boolean('active')->default(true);
            $table->boolean('is_published')->default(true);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
