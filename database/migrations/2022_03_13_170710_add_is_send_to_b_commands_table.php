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
        Schema::table('b_commands', function (Blueprint $table) {
            $table->boolean('is_send')->default(false)->after('active');
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::table('b_commands', function (Blueprint $table) {
            $table->dropColumn(['is_send']);
        });
    }
};
