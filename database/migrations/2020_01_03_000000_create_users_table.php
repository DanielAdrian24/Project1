<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('password');
            $table->string('email');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('role_id')->nullable();
            $table->string('active_flag')->nullable();
            $table->integer("created_by")->nullable();
            $table->integer("last_update_by")->nullable();
            $table->timestamp('email_verified_at');
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('sys_customers');
            $table->foreign('role_id')->references('id')->on('sys_roles');
        });
        DB::table('users')->insert([
            'username'     => 'admin',
            'password'     => bcrypt('password'),
            'email'     => 'admin@admin.com',
            'customer_id'   => 1,
            'role_id' => 1,
            'active_flag'     => 'Y',
            'last_update_by' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
