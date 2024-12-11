<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dealer_details', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->references('id')->on('product_service_details')->onDelete('cascade');
            
            $table->unsignedBigInteger('dealer_id');
            $table->foreign('dealer_id')->references('id')->on('dealers')->onDelete('cascade');
            
            $table->text('product_description');
            
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('dealers_status')->onDelete('cascade');
            
          
            $table->unsignedBigInteger('payment_status_id');
            $table->foreign('payment_status_id')->references('id')->on('payment_statuses')->onDelete('cascade');
            
           
            $table->decimal('amount', 10, 2)->nullable();
            $table->date('amount_received_date')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dealer_details');
    }
}
