<?php

declare(strict_types=1);

use App\Models\Client;
use App\Models\Expense\ExpenseCategory;
use App\Models\Finance\Provider;
use App\Models\Schedule\Schedule;
use App\Models\Utilities\Currency;
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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');

            $table->foreignIdFor(ExpenseCategory::class, 'category_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Client::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Provider::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Tax::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Currency::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Schedule::class)->nullable()->constrained()->nullOnDelete();

            $table->string('code');
            $table->string('full_number')->unique();
            $table->string('name');
            $table->longText('note')->nullable();

            $table->float('price_total')->default(0);
            $table->float('price_ht')->default(0);
            $table->float('price_tax')->default(0);

            $table->date('expense_date');

            $table->json('conditions')->nullable();
            $table->boolean('active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
