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
        Schema::table('td_bukti_pengeluarans', function (Blueprint $table) {
            $table->unsignedBigInteger('td_pa_id');
            $table->unsignedBigInteger('td_kpa_id');
            $table->unsignedBigInteger('td_bpp_id');

            $table->foreign('td_pa_id')->references('id_biodata')->on('biodatas');
            $table->foreign('td_kpa_id')->references('id_biodata')->on('biodatas');
            $table->foreign('td_bpp_id')->references('id_biodata')->on('biodatas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('td_bukti_pengeluarans', function (Blueprint $table) {
            $table->dropColumn('td_pa_id');
            $table->dropColumn('td_kpa_id');
            $table->dropColumn('td_bpp_id');
        });
    }
};