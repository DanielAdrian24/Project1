<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BupotHeader extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bupot_header', function (Blueprint $table) {
            $table->id('bupot_id');
            $table->string('bupot_number',60);
            $table->date('bupot_date');
            $table->integer('dpp_amount');
            $table->integer('percentage');
            $table->integer('pph_amount');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string("status",1)->nullable();
            $table->string("reason",255)->nullable();
            $table->integer('user_id');
            $table->date('creation_date');
            $table->integer('last_updated_by');
            $table->date('last_update_date');
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('sys_customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bupot_lines');
        Schema::dropIfExists('bupot_header');
        //
    }
}
