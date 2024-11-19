<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_details', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customer_details')->onDelete('cascade');

            $table->unsignedBigInteger('product_service_id');
            $table->foreign('product_service_id')->references('id')->on('product_service_details')->onDelete('cascade');

            $table->decimal('amount', 10, 2); // Amount for the payment (10 digits total, 2 decimal places)

            $table->unsignedBigInteger('payment_status'); // Status of the payment (e.g., "Completed", "Pending")
            $table->foreign('payment_status')->references('id')->on('payment_statuses')->onDelete('cascade');

            $table->unsignedBigInteger('payment_mode'); // Mode of payment (e.g., "Cash", "Credit Card")
            $table->foreign('payment_mode')->references('id')->on('payment_modes')->onDelete('cascade');

            $table->timestamp('payment_date'); // Date and time of payment

            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_details');
    }
}
