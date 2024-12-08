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
        Schema::create('mahasiswa',function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('nama_lengkap');
            $table->string('nim')->unique();
            $table->string('email');
            $table->enum('jenis_kelamin',['tidak diketahui','laki-laki','perempuan'])->default('tidak diketahui');
            $table->string('jurusan');
            $table->string('alamat');
            $table->string('telepon');
            $table->string('angkatan');
            $table->enum('status',['aktif','cuti','lulus','keluar'])->default('aktif');
            $table->decimal('ipk', 8, 2)->default(0.00);
            $table->unsignedBigInteger('wali_dosen');
            $table->string('semester');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
