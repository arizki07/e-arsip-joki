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
        Schema::create('spj_register_uraian', function (Blueprint $table) {
            $table->id('id_register_uraian');
            $table->unsignedBigInteger('id_register_kas');
            $table->unsignedBigInteger('id_surat_pengantar');
            $table->string('kertas_100');
            $table->string('kertas_50');
            $table->string('kertas_20');
            $table->string('kertas_10');
            $table->string('kertas_5');
            $table->string('kertas_1');
            $table->string('logam_1000');
            $table->string('logam_500');
            $table->string('logam_100');
            $table->string('logam_50');
            $table->string('logam_25');
            $table->string('logam_10');
            $table->string('logam_5');
            $table->timestamps();

            $table->foreign('id_register_kas')->references('id_register_kas')->on('spj_register_kas');
            $table->foreign('id_surat_pengantar')->references('id_surat_pengantar')->on('spj_surat_pengantar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spj_register_uraian');
    }
};
