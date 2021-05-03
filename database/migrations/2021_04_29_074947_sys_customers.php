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
            $table->string('attribute1',255);
            $table->string('attribute2',255);
            $table->string('attribute3',255);
            $table->string('attribute4',255);
            $table->string('attribute5',255);
            $table->string('active_flag',255);
            $table->string('created_by',255);
            $table->string('updated_by',255);
            $table->rememberToken();
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
        Schema::dropIfExists('sys_customers');
    }
}
