<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_menus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_id');
            $table->foreign('menu_id')->references('id')->on('menus');
            $table->string('name');
            $table->string('component')->nullable();
            $table->string('slug')->nullable();
            $table->string('view_path')->nullable();
            $table->string('icon')->nullable();
            $table->string('sub_menu')->nullable();
            $table->string('sub_menu_icon')->nullable();
            $table->string('sub_menu2')->nullable();
            $table->string('sub_menu2_icon')->nullable();
            
            $table->integer('sort_order')->nullable();
            $table->timestamps();
        });
        // $seeder = new SideBarMenuSeeder();
        // $seeder->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_menus');
    }
}
