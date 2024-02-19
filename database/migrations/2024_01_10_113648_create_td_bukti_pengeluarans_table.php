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
        Schema::create('td_bukti_pengeluarans', function (Blueprint $table) {
            $table->id('id_td_bukti');
            $table->unsignedBigInteger('td_id_pengajuan');
            $table->unsignedBigInteger('td_bp_id');
            $table->string('td_biaya', 50);
            $table->string('td_jumlah_biaya', 50);
            $table->json('td_uraian');
            $table->timestamps();

            $table->foreign('td_id_pengajuan')->references('id_pengajuan')->on('pengajuans');
            $table->foreign('td_bp_id')->references('id_biodata')->on('biodatas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('td_bukti_pengeluarans');
    }
};