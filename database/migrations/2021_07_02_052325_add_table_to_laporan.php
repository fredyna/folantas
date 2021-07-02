<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableToLaporan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('laporan', function (Blueprint $table) {
            $table->string('lokasi', 200)->after('foto')->nullable();
            $table->integer('panjang')->after('lokasi')->nullable();
            $table->string('penyebab', 150)->after('panjang')->nullable();
            $table->enum('status', ['PENDING', 'DISETUJUI', 'DITOLAK'])->after('deskripsi')->default('PENDING');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('laporan', function (Blueprint $table) {
            $table->dropColumn('lokasi');
            $table->dropColumn('panjang');
            $table->dropColumn('penyebab');
            $table->dropColumn('status');
        });
    }
}
