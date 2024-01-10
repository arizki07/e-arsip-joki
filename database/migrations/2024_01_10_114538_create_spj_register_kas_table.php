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
            $table->id('id_spj_reg_kas');
            $table->unsignedBigInteger('spjr_pengantar_id');
            $table->date('spjr_tgl_dibuat', 50);
            $table->date('spjr_tgl_penutup_kas', 50);
            $table->string('spjr_nama_penutup_kas', 150);
            $table->date('spjr_tgl_penutup_lalu', 50);
            $table->string('spjr_jml_penerimaan', 150);
            $table->string('spjr_jml_pengeluaran', 150);
            $table->string('spjr_saldo_buku', 150);
            $table->string('spjr_saldo_kas', 150);
            $table->string('spjr_min-plus', 150);
            $table->text('spjr_uraian_kertas');
            $table->text('spjr_uraian_logam');
            $table->text('spjr_uraian_kertas_berharga');
            $table->text('spjr_uraian_perbedaan');
            $table->timestamps();
            
            $table->foreign('spjr_pengantar_id')->references('id_spj_pengantar')->on('spj_pengantars');
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
