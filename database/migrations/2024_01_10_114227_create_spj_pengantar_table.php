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
        Schema::create('spj_pengantars', function (Blueprint $table) {
            $table->id('id_spj_pengantar');
            $table->unsignedBigInteger('spjp_nota_dinas_id');
            $table->unsignedBigInteger('spjp_pptk_id');
            $table->unsignedBigInteger('spjp_bpp_id');
            $table->string('spjp_nomor', 50);
            $table->string('spjp_sifat', 20);
            $table->string('spjp_lampiran', 10);
            $table->text('spjp_uraian');
            $table->string('spjp_biaya', 50);
            $table->date('spjp_tanggal', 50);
            $table->timestamps();

            $table->foreign('spjp_nota_dinas_id')->references('id_nota_dinas')->on('nota_dinas');
            $table->foreign('spjp_pptk_id')->references('id_biodata')->on('biodatas');
            $table->foreign('spjp_bpp_id')->references('id_biodata')->on('biodatas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spj_pengantars');
    }
};
