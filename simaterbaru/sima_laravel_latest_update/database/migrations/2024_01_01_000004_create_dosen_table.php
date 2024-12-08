<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('dosen', function (Blueprint $table) {
            $table->string('nip', 18)->primary();
            $table->string('nama', 50);
            $table->foreignId('id_prodi')->constrained('program_studi', 'id_prodi');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dosen');
    }
};
