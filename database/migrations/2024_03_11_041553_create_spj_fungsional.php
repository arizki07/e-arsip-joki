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
        Schema::create('spj_fungsional', function (Blueprint $table) {
            $table->id('id_fungsional');
            $table->unsignedBigInteger('id_bku');
            $table->unsignedBigInteger('id_surat_pengantar');
            $table->string('urusan');
            $table->string('organisasi');
            $table->string('program');
            $table->string('kegiatan');
            $table->string('bulan');
            $table->timestamps();

            $table->foreign('id_bku')->references('id_bku')->on('spj_bku')->onDelete('cascade');;
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
        Schema::dropIfExists('spj_fungsional');
    }
};
