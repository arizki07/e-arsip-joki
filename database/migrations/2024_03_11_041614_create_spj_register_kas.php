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
        Schema::create('spj_register_kas', function (Blueprint $table) {
            $table->id('id_register_kas');
            $table->unsignedBigInteger('id_bku');
            $table->unsignedBigInteger('id_fungsional');
            $table->unsignedBigInteger('id_biodata');
            $table->unsignedBigInteger('id_surat_pengantar');
            $table->string('tgl_penutupan_lalu');
            $table->string('saldo_buku');
            $table->string('saldo_kas');
            $table->string('positif_negatif');
            $table->string('kertas_berharga');
            $table->string('perbedaan');
            $table->timestamps();

            $table->foreign('id_bku')->references('id_bku')->on('spj_bku')->onDelete('cascade');;
            $table->foreign('id_fungsional')->references('id_fungsional')->on('spj_fungsional')->onDelete('cascade');;
            $table->foreign('id_biodata')->references('id_biodata')->on('biodatas');
            $table->foreign('id_surat_pengantar')->references('id_surat_pengantar')->on('spj_surat_pengantar')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spj_register_kas');
    }
};
