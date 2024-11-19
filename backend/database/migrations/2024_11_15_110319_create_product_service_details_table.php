<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductServiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_service_details', function (Blueprint $table) {
            $table->id();
            $table->string('service_id')->unique();

            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customer_details')->onDelete('cascade');

            $table->string('product_type');
            $table->string('product_name');
            $table->string('serial_number')->nullable();
            $table->string('model_number')->nullable();
            $table->text('description')->nullable();
            $table->text('other_collected_item')->nullable();
            $table->date('product_recieved_date');

            $table->unsignedBigInteger('service_status');
            $table->foreign('service_status')->references('id')->on('service_statuses')->onDelete('cascade');

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
        Schema::dropIfExists('product_service_details');
    }
}
