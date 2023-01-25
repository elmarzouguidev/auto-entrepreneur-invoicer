<?php

declare(strict_types=1);

use App\Models\Stock\City;
use App\Models\Stock\Warehouse;
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
        Schema::create('adjustments', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');

            $table->foreignIdFor(Warehouse::class)->constrained();
            $table->foreignIdFor(City::class)->nullable()->constrained();
            $table->foreignIdFor(User::class)->constrained();

            $table->date('date')->useCurrent();
            $table->string('reference')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('adjustments');
    }
};
