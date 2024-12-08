<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jadwal_items',function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('id_jadwal');
            $table->string('kode_mk');
            $table->unsignedBigInteger('kode_ruang');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->string('hari');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_items');
    }
};
