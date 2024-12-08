<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id('id_jadwal');  
            $table->string('kode_mk', 8);
            $table->string('nip', 18);
            $table->unsignedBigInteger('kode_ruang');
            $table->string('kelas');
            $table->integer('kuota_kelas')->default(0); // Tambahkan default value
            $table->string('tahun_ajaran');
            $table->string('semester');
            $table->time('waktu_mulai')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->time('waktu_selesai')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('hari');
            $table->timestamps();

            $table->foreign('kode_mk')->references('kode_mk')->on('mata_kuliah')->onDelete('cascade');
            $table->foreign('nip')->references('nip')->on('dosen')->onDelete('cascade');
            $table->foreign('kode_ruang')->references('kode_ruang')->on('ruang')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('jadwal');
    }
};
