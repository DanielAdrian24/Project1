<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BupotLines extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bupot_lines', function (Blueprint $table) {
            $table->unsignedBigInteger('bupot_id')->nullable();
            $table->integer('bupot_line_id');
            $table->unsignedBigInteger('kwt_id')->nullable();
            $table->integer("created_by");
            $table->date("creation_date");
            $table->date('last_update_date');
            $table->foreign('bupot_id')->references('bupot_id')->on('bupot_header');
            $table->foreign('kwt_id')->references('kwt_id')->on('listing_kwt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
