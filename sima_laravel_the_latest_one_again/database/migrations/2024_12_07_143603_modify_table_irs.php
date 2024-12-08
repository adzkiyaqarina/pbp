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
        Schema::table('irs',function(Blueprint $table){
            $table->dropColumn('waktu_pengajuan');
            $table->dropColumn('waktu_persetujuan');
            $table->dropColumn('waktu_pembukaan_irs');
            $table->dropColumn('waktu_perbaikan');
            $table->enum('status_lock_irs',['locked','open'])->default('open');
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
