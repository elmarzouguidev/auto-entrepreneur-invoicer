<?php

declare(strict_types=1);

use App\Models\Client;
use App\Models\Expense\Expense;
use App\Models\Expense\ExpenseCategory;
use App\Models\Finance\Provider;
use App\Models\Utilities\Currency;
use App\Models\Utilities\PaymentType;
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
        Schema::create('expense_invoices', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');

            $table->foreignIdFor(Currency::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(ExpenseCategory::class, 'category_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Tax::class)->index()->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(PaymentType::class)->index()->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Expense::class)->index()->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Client::class)->index()->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Provider::class)->index()->nullable()->constrained()->nullOnDelete();

            $table->string('code');
            $table->string('full_number')->unique();

            $table->float('price_total')->default(0);
            $table->float('price_ht')->default(0);
            $table->float('price_tax')->default(0);

            $table->date('invoice_date');

            $table->string('reference')->nullable();
            $table->json('conditions')->nullable();
            $table->longText('note')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('expense_invoices');
    }
};
