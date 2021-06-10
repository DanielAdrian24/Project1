<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ListingKwt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listing_kwt', function (Blueprint $table) {
            $table->id('kwt_id');
            $table->string('kwt_number',60);
            $table->date('kwt_date');
            $table->string('kwt_type',60);
            $table->integer('dpp_amount');
            $table->integer('ppn_amount');
            $table->integer('pph_amount');
            $table->string("used_status",1);
            $table->integer("created_by");
            $table->date('creation_date');
            $table->date('last_update_date');
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
        //
    }
}
