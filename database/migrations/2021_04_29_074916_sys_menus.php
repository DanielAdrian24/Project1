<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SysMenus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_menus', function (Blueprint $table) {
            $table->id('menu_id');
            $table->string('menu_name');
            $table->string('menu_desc');
            $table->unsignedBigInteger('role_id');
            $table->integer('seq');
            $table->string('active_flag');
            $table->string('is_detail');
            $table->integer("created_by")->nullable();
            $table->integer("last_update_by")->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('role_id')->references('id')->on('sys_roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_menus');
    }
}
