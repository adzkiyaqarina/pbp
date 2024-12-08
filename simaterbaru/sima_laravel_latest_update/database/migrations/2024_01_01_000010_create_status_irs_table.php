<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('status_irs', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // draft, final, disetujui, perbaikan, batal
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('status_irs');
    }
};
