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
        Schema::create('biodatas', function (Blueprint $table) {
            $table->id('id_biodata');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('jabatan_id');
            $table->string('nama', 50);
            $table->string('email', 150);
            $table->string('nip', 12);
            $table->date('tgl_lahir');
            $table->text('alamat');
            $table->string('foto_ttd', 200);
            $table->timestamps();

            $table->foreign('user_id')->references('id_users')->on('users');
            $table->foreign('jabatan_id')->references('id_jabatan')->on('jabatans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('biodatas');
    }
};
