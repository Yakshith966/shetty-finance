<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained('branches')->onDelete('cascade');
            // $table->foreign('branch_id')->references('id')->on('branches');
            $table->string('name',30);
            $table->string('email',50)->unique()->nullable();
            $table->string('phone_number',15);
            $table->string('alt_phone_number',15)->nullable();
            $table->text('address');
            $table->string('document_proof_id');
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
        Schema::dropIfExists('members');
    }
}
