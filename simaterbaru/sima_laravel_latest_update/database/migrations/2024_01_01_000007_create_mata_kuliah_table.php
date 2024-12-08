<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('mata_kuliah', function (Blueprint $table) {
            $table->id(); // Tambahkan kolom id sebagai primary key
            $table->string('kode_mk', 8)->unique(); // Tetap gunakan kode_mk sebagai kolom unik
            $table->string('nama', 50);
            $table->integer('sks');
            $table->string('nip_dosen', 18);
            $table->unsignedBigInteger('id_prodi'); // Foreign key ke program_studi

            // Foreign key constraints
            $table->foreign('id_prodi')->references('id_prodi')->on('program_studi')->onDelete('cascade');
            $table->foreign('nip_dosen')->references('nip')->on('dosen')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mata_kuliah');
    }
};
