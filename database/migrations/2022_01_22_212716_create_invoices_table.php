<?php

use App\Models\Client;
use App\Models\Utilities\PaymentType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            
            $table->foreignIdFor(PaymentType::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Client::class)->constrained()->cascadeOnDelete();

            $table->string('code');
            $table->string('full_number')->unique();

            $table->string('bl_code')->nullable();
            $table->string('bc_code')->nullable();

            $table->unsignedBigInteger('price_total')->default(0);

            $table->string('remise')->default('0');

            $table->date('invoice_date')->nullable();
            $table->date('due_date')->nullable();
            $table->date('payment_date')->nullable();

            $table->boolean('is_paid')->default(false);

            $table->boolean('active')->default(true);

            $table->mediumText('admin_notes')->nullable();

            $table->mediumText('condition_general')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
