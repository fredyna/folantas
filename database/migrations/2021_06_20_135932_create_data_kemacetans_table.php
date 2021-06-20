<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataKemacetansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_kemacetan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('lokasi', 200);
            $table->integer('panjang');
            $table->string('penyebab', 150);
            $table->dateTime('waktu');
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
        Schema::dropIfExists('data_kemacetan');
    }
}
