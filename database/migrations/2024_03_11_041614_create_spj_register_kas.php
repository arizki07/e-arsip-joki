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
            $table->string('tgl_penutupan_lalu');
            $table->string('saldo_buku');
            $table->string('saldo_kas');
            $table->string('positif_negatif');
            $table->string('kertas_berharga');
            $table->string('perbedaan');
            $table->timestamps();

            $table->foreign('id_bku')->references('id_bku')->on('spj_bku');
            $table->foreign('id_fungsional')->references('id_fungsional')->on('spj_fungsional');
            $table->foreign('id_biodata')->references('id_biodata')->on('biodatas');
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
