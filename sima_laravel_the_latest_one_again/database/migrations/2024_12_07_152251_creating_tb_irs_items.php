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
        Schema::create('irs_items',function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('id_irs');
            $table->unsignedBigInteger('id_mata_kuliah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('irs_items');
    }
};
