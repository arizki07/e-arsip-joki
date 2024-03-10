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
        Schema::create('testing_tempat_uraian', function (Blueprint $table) {
            $table->id('id_uraian');
            $table->unsignedBigInteger('testing_id');
            $table->string('kode_rekening');
            $table->string('rekening');
            $table->date('tgl');
            $table->string('penerimaan');
            $table->string('pengeluaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('testing_tempat_uraian');
    }
};
