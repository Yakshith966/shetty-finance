<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCarryAndExtraColumnsToLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->decimal('carried_forward_amount', 10, 2)->default(0)->after('principal_paid');
            $table->decimal('extra_amount', 10, 2)->default(0)->after('carried_forward_amount');
        });
    }

    public function down()
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->dropColumn(['carried_forward_amount', 'extra_amount']);
        });
    }

}
