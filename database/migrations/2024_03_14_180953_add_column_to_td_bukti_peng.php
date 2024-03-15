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
            $table->string('no_bukti');
            $table->string('total_uraian');
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
            $table->dropColumn('no_bukti');
            $table->dropColumn('total_uraian');
        });
    }
};