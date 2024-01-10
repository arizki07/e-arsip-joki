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
        Schema::create('spj_pajaks', function (Blueprint $table) {
            $table->id('id_spj_pajak');
            $table->unsignedBigInteger('spjpa_pengantar_id');
            $table->string('spjpa_urusan_pemerintahan', 150);
            $table->date('spjpa_tgl_laporan', 50);
            $table->date('spjpa_tanggal', 50);
            $table->text('spjpa_uraian');
            $table->timestamps();
            
            $table->foreign('spjpa_pengantar_id')->references('id_spj_pengantar')->on('spj_pengantars');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spj_pajaks');
    }
};
