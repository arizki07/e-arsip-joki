<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spj_fungsional_uraian', function (Blueprint $table) {
            $table->id('id_fungsional_uraian');
            $table->unsignedBigInteger('id_fungsional');
            $table->string('kode_rekening');
            $table->string('tipe');
            $table->string('uraian');
            $table->string('jumlah_anggaran');
            $table->string('sd_bulan_lalu');
            $table->string('bulan_ini');
            $table->string('sd_bulan_ini');
            $table->string('jumlah_spj');
            $table->string('sisa_pagu_anggaran');
            $table->timestamps();

            $table->foreign('id_fungsional')->references('id_fungsional')->on('spj_fungsional');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spj_fungsional_uraian');
    }
};
