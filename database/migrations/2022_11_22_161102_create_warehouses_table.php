<?php

declare(strict_types=1);

use App\Models\Stock\City;
use App\Models\User;
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
        Schema::create('warehouses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->longText('address');
            $table->longText('map')->nullable();
            $table->foreignIdFor(City::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(User::class)->nullable();
            $table->timestamps();
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouses');
    }
};
