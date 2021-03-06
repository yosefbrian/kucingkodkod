<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Bp2a extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bp2a', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('spd_id') -> unsigned() -> default(0);
            $table->foreign('spd_id')
                    ->references('id')->on('spdcenter')
                    ->onDelete('cascade');
            $table->string('no_spd');
            $table->string('no_pp');
            $table->string('no_spp');
            $table->string('tgl_spp')->nullable();
            $table->string('tiket_berangkat')->nullable();
            $table->string('tiket_kembali')->nullable();
            $table->string('dpr')->nullable();
            $table->string('penginapan')->nullable();
            $table->string('penginapan_tanpa_bukti')->nullable();
            $table->string('uh')->nullable();
            $table->string('uhr')->nullable();
            $table->string('kekurangan')->nullable();
            $table->string('perjalanan_dinas')->nullable();
            $table->string('angkutan_pegawai')->nullable();
            $table->string('angkutan_keluarga')->nullable();
            $table->string('angkutan_prt')->nullable();
            $table->string('pengepakan')->nullable();
            $table->string('angkutan_barang')->nullable();
            $table->string('uang_harian_tiba')->nullable();
            $table->string('uang_harian_bertolak')->nullable();
            $table->string('uang_harian_pembantu')->nullable();
            $table->string('total');
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
        
        Schema::drop('bp2a');
    }
}
