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
            $table->dropForeign(['status_id']);
            $table->dropColumn('status_id');
            $table->enum('status',['pending','approved','rejected'])->default('pending');
            $table->unsignedBigInteger('sks')->nullable();
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
