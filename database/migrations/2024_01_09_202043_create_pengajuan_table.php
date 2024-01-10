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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id('id_pengajuan');
            $table->unsignedBigInteger('p_pa_id');
            $table->unsignedBigInteger('p_kpa_id');
            $table->unsignedBigInteger('p_bpp_id');
            $table->string('p_nama_kegiatan');
            $table->string('p_sub_kegiatan');
            $table->date('p_tanggal');
            $table->string('p_biaya', 50);
            $table->timestamps();

            $table->foreign('p_pa_id')->references('id_biodata')->on('biodatas');
            $table->foreign('p_kpa_id')->references('id_biodata')->on('biodatas');
            $table->foreign('p_bpp_id')->references('id_biodata')->on('biodatas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengajuans');
    }
};
