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
        Schema::create('testing_import', function (Blueprint $table) {
            $table->id('id_testing');
            $table->unsignedBigInteger('pa_id');
            $table->unsignedBigInteger('kpa_id');
            $table->unsignedBigInteger('bpp_id');
            $table->string('nama_kegiatan');
            $table->string('sub_kegiatan');
            $table->string('status')->default('1');
            $table->date('tgl');
            $table->string('total_biaya', 50);
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
        Schema::dropIfExists('testing_import');
    }
};
