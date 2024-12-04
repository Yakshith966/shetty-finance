<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPaymentModeToDealerDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dealer_details', function (Blueprint $table) {
            $table->unsignedBigInteger('payment_mode')->after('payment_status_id')->nullable();
            $table->foreign('payment_mode')->references('id')->on('payment_modes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dealer_details', function (Blueprint $table) {
            //
        });
    }
}
