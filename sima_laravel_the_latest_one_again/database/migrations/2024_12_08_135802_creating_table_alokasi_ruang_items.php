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
        Schema::create('alokasi_ruang_item',function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('id_alokasi');
            $table->unsignedBigInteger('id_gedung');
            $table->unsignedBigInteger('id_ruang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alokasi_ruang_item');
    }
};
