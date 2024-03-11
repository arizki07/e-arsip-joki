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
        Schema::create('spj_surat_pengantar', function (Blueprint $table) {
            $table->id('id_surat_pengantar');
            $table->unsignedBigInteger('id_td_bukti');
            $table->string('nomor_surat');
            $table->string('sifat');
            $table->string('lampiran');
            $table->string('perihal');
            $table->date('tanggal');
            $table->string('biaya');
            $table->string('kegiatan');
            $table->timestamps();

            $table->foreign('id_td_bukti')->references('id_td_bukti')->on('td_bukti_pengeluarans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spj_surat_pengantar');
    }
};
