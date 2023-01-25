<?php

declare(strict_types=1);

use App\Models\Finance\Buy\BuyInvoice;
use App\Models\Finance\Provider;
use App\Models\Utilities\PaymentType;
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
        Schema::create('buy_estimates', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            $table->foreignIdFor(PaymentType::class)
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignIdFor(Provider::class)
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignIdFor(BuyInvoice::class)
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('code')->nullable();

            $table->unsignedBigInteger('price_ht')->default(0);
            $table->unsignedBigInteger('price_total')->default(0);
            $table->unsignedBigInteger('price_tva')->default(0);

            $table->integer('status')->default(\App\Constants\Response::DEVIS_EN_ATTENTE);

            $table->date('estimate_date')->nullable();
            $table->date('due_date')->nullable();

            $table->boolean('active')->default(true);
            $table->boolean('is_invoiced')->default(false);

            $table->longText('condition_general')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('buy_estimates');
    }
};
