<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateWaktuDataKecelakaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_kecelakaan', function (Blueprint $table) {
            $table->dateTime('waktu_laka')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_kecelakaan', function (Blueprint $table) {
            $table->date('waktu_laka')->change();
        });
    }
}
