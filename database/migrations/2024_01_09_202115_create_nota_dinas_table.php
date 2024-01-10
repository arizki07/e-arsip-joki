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
        Schema::create('nota_dinas', function (Blueprint $table) {
            $table->id('id_nota_dinas');
            $table->unsignedBigInteger('nd_kpa_id');
            $table->string('nd_nama_kegiatan');
            $table->string('nd_sub_kegiatan');
            $table->string('nd_perihal');
            $table->string('nd_nomor_nota', 50);
            $table->text('nd_uraian_kegiatan');
            $table->date('nd_tanggal');
            $table->string('nd_jumlah_biaya', 50);
            $table->timestamps();

            $table->foreign('nd_kpa_id')->references('id_biodata')->on('biodatas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nota_dinas');
    }
};
