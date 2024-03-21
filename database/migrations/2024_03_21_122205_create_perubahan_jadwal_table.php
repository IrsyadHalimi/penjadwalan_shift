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
        Schema::create('perubahan_jadwal', function (Blueprint $table) {
            $table->integer('id_perubahan', 11);
            $table->foreignId('id_user', 11);
            $table->foreignId('id_jadwal', 11);
            $table->date('tanggal_perubahan');
            $table->string('alasan_perubahan', 255);
            $table->string('status', 50);
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
        Schema::dropIfExists('perubahan_jadwal');
    }
};
