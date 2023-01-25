<?php

use App\Models\Client;
use App\Models\Finance\Invoice;
use App\Models\Utilities\PaymentType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceAvoirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_avoirs', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            $table->foreignIdFor(PaymentType::class)->index()->constrained();
            $table->foreignIdFor(Client::class)->index()->nullable()->constrained();
            $table->foreignIdFor(Invoice::class)->index()->nullable()->constrained();

            $table->string('full_number')->unique();
            $table->string('code');
            $table->string('invoice_number');

            $table->string('bl_code')->nullable();
            $table->string('bc_code')->nullable();

            $table->unsignedBigInteger('price_ht')->default(0);
            $table->unsignedBigInteger('price_total')->default(0);
            $table->unsignedBigInteger('price_tva')->default(0);

            $table->string('status')->default('impayee');

            $table->date('invoice_date');
            $table->date('due_date')->nullable();
            $table->date('payment_date')->nullable();

            $table->mediumText('admin_notes')->nullable();
            $table->mediumText('client_notes')->nullable();
            $table->mediumText('condition_general')->nullable();

            $table->boolean('active')->default(true);

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
        Schema::dropIfExists('invoice_avoirs');
    }
}
