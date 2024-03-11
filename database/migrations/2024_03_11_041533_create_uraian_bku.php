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
        Schema::create('spj_bku_uraian', function (Blueprint $table) {
            $table->id('id_bku_uraian');
            $table->unsignedBigInteger('id_bku');
            $table->string('no_urut');
            $table->date('tanggal');
            $table->string('uraian');
            $table->string('kode_rekening');
            $table->string('penerimaan');
            $table->string('pengeluaran');
            $table->string('saldo');
            $table->string('keterangan');
            $table->timestamps();

            $table->foreign('id_bku')->references('id_bku')->on('spj_bku');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spj_bku_uraian');
    }
};
