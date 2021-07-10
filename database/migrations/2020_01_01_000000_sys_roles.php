<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SysRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_roles', function (Blueprint $table) {
            $table->id();
            $table->string('role_name',100);
            $table->string('role_desc',255);
        });
        DB::table('sys_roles')->insert([
            'role_name'     => 'Admin',
            'role_desc'     => 'Admin Desc'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_roles');
    }
}
