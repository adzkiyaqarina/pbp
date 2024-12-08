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
        Schema::table('alokasi_ruang',function(Blueprint $table){
            $table->dropColumn('id_departemen');
            $table->unsignedBigInteger('id_fakultas');
            $table->unsignedBigInteger('id_prodi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
