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
        Schema::create('spj_bku', function (Blueprint $table) {
            $table->id('id_bku');
            $table->unsignedBigInteger('id_td_bukti');
            $table->unsignedBigInteger('id_kpa');
            $table->unsignedBigInteger('id_pptk');
            $table->unsignedBigInteger('id_bpp');
            $table->date('tanggal');
            $table->string('kas');
            $table->string('tunai');
            $table->string('saldo_bank');
            $table->string('sp2d');
            $table->timestamps();

            $table->foreign('id_td_bukti')->references('id_td_bukti')->on('td_bukti_pengeluarans');
            $table->foreign('id_kpa')->references('id_biodata')->on('biodatas');
            $table->foreign('id_pptk')->references('id_biodata')->on('biodatas');
            $table->foreign('id_bpp')->references('id_biodata')->on('biodatas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spj_bku');
    }
};
