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
            $table->id('id_spj_bku');
            $table->unsignedBigInteger('spjb_pengantar_id');
            $table->date('spjb_tgl_laporan', 50);
            $table->date('spjb_tanggal', 50);
            $table->text('spjb_uraian');
            $table->string('spjb_biaya', 50);
            $table->timestamps();

            $table->foreign('spjb_pengantar_id')->references('id_spj_pengantar')->on('spj_pengantars');
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
