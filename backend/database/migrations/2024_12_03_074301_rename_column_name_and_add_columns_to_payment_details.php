<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnNameAndAddColumnsToPaymentDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_details', function (Blueprint $table) {
            $table->renameColumn('amount', 'paid_amount');
            $table->decimal('repair_cost', 10, 2)->after('product_service_id');
            $table->decimal('advance_amount', 10, 2)->nullable()->after('repair_cost');
            $table->decimal('remaining_amount', 10, 2)->nullable()->after('advance_amount');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_details', function (Blueprint $table) {
            $table->renameColumn('paid_amount', 'amount');
            $table->dropColumn('repair_cost');
            $table->dropColumn('advance_amount');
            $table->dropColumn('remaining_amount');
        });
    }
}
