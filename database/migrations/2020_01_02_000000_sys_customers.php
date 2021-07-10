<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SysCustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_number',255);
            $table->string('customer_name',255);
            $table->string('description',255);
            $table->string('email',255);
            $table->string('attribute1',255)->nullable();
            $table->string('attribute2',255)->nullable();
            $table->string('attribute3',255)->nullable();
            $table->string('attribute4',255)->nullable();
            $table->string('attribute5',255)->nullable();
            $table->string('active_flag',255);
            $table->string('created_by',255);
            $table->string('updated_by',255);
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('sys_customers')->insert([
            'customer_number'     => 1,
            'customer_name'     => 'Admin',
            'description'     => 'AdminOnly',
            'email'   => 'admin@admin.com',
            'active_flag' => 'Y',
            'created_by' => 1,
            'updated_by' => 1,
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
        Schema::dropIfExists('bupot_header');
        Schema::dropIfExists('users');
        Schema::dropIfExists('sys_customers');
    }
}
