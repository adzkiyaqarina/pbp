<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ruang', function (Blueprint $table) {
            $table->id('kode_ruang');
            $table->string('nama', 50);
            $table->integer('kapasitas');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ruang');
    }
};
