<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userid');
            $table->string('trxid')->nullable();
            $table->decimal('amount', 10, 2);
            $table->decimal('nid_balance', 10, 2);
            $table->decimal('vat', 10, 2);
            $table->decimal('total_amount', 10, 2);
            $table->string('mobile_no')->nullable();
            $table->string('payment_wallet')->nullable();
            $table->string('method')->nullable();
            $table->string('mer_trxid')->nullable();
            $table->dateTime('date')->nullable();
            $table->string('status')->nullable();
            $table->integer('month')->nullable();
            $table->integer('year')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('ipn')->nullable();
            $table->string('payment_url')->nullable();
            $table->decimal('old_nid_balance', 10, 2);

            // Add any additional columns you may need

            // Timestamps
            $table->timestamps();

            // Foreign key constraint for userid
            $table->foreign('userid')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
