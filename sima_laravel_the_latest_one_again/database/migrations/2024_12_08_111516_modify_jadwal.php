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
        Schema::table('jadwal',function(Blueprint $table){
            $table->dropForeign(['kode_mk']);
            $table->dropColumn('kode_mk');
            $table->dropForeign(['nip']);
            $table->dropColumn('nip');
            $table->dropForeign(['kode_ruang']);
            $table->dropColumn('kode_ruang');
            $table->dropColumn('kuota_kelas');
            $table->dropColumn('waktu_mulai');
            $table->dropColumn('waktu_selesai');
            $table->dropColumn('hari');
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
