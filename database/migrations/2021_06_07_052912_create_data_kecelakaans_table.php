<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataKecelakaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_kecelakaan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('jenis_laka', 20);
            $table->string('sebab_laka', 30);
            $table->string('tkp', 20);
            $table->enum('hari', ['SENIN', 'SELASA', 'RABU', 'KAMIS', 'JUMAT', 'SABTU', 'MINGGU']);
            $table->dateTime('waktu_laka');
            $table->string('kendaraan_terlibat', 30);
            $table->enum('jk_korban', ['LAKI-LAKI', 'PEREMPUAN']);
            $table->tinyInteger('usia_korban');
            $table->string('profesi_korban', 30);
            $table->string('pendidikan_korban', 15);
            $table->string('sim_korban', 10);
            $table->string('jk_pelaku', 10)->nullable();
            $table->tinyInteger('usia_pelaku')->nullable();
            $table->string('profesi_pelaku', 30)->nullable();
            $table->string('pendidikan_pelaku', 15)->nullable();
            $table->string('sim_pelaku', 10)->nullable();

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
        Schema::dropIfExists('data_kecelakaan');
    }
}
