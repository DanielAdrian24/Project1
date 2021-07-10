<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SysMenusDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_menus_details', function (Blueprint $table) {
            $table->id('menu_detail_id');
            $table->unsignedBigInteger('menu_id');
            $table->string('menu_detail_name');
            $table->string('menu_detail_desc');
            $table->string('active_flag');
            $table->integer('seq');
            $table->integer("created_by")->nullable();
            $table->integer("last_update_by")->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('menu_id')->references('menu_id')->on('sys_menus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_menus_details');
    }
}
