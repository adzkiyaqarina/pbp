// database/migrations/2024_01_01_000003_create_program_studi_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('program_studi', function (Blueprint $table) {
            $table->id('id_prodi');
            $table->string('nama', 50);
            $table->foreignId('id_fakultas')->constrained('fakultas', 'id_fakultas');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('program_studi');
    }
};
