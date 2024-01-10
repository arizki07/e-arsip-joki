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
        Schema::create('spj_ba_kas', function (Blueprint $table) {
            $table->id('id_spj_ba_kas');
            $table->unsignedBigInteger('spjba_pengantar_id');
            $table->string('spjba_urusan_pemerintahan', 150);
            $table->string('spjba_nomor_surat', 150);
            $table->date('spjba_tanggal', 50);
            $table->text('spjba_uraian');
            $table->timestamps();
            
            $table->foreign('spjba_pengantar_id')->references('id_spj_pengantar')->on('spj_pengantars');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spj_ba_kas');
    }
};
