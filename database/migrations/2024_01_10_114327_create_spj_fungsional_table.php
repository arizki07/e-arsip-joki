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
        Schema::create('spj_fungsionals', function (Blueprint $table) {
            $table->id('id_spj_fungsional');
            $table->unsignedBigInteger('spjf_pengantar_id');
            $table->string('spjf_urusan_pemerintahan', 150);
            $table->date('spjf_tgl_laporan', 50);
            $table->date('spjf_tanggal', 50);
            $table->text('spjf_uraian');
            $table->timestamps();

            $table->foreign('spjf_pengantar_id')->references('id_spj_pengantar')->on('spj_pengantars');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spj_fungsionals');
    }
};
