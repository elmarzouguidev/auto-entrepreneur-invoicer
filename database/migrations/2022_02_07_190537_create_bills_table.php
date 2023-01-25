<?php

use App\Models\Utilities\PaymentType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            $table->foreignIdFor(PaymentType::class)
                ->index()
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->bigInteger('billable_id');
            $table->string('billable_type');

            $table->string('code')->unique();
            $table->string('full_number')->unique();

            $table->string('reference')->nullable();

            $table->unsignedBigInteger('price_total')->default(0);

            $table->string('status')->default('accepted');

            $table->date('bill_date')->nullable();

            $table->mediumText('notes')->nullable();

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
        Schema::dropIfExists('bills');
    }
}
