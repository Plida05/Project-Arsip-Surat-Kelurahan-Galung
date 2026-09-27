<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kategori_surat', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 10)->unique();      // contoh: UND, PRM, PBT
            $table->string('nama');                      // contoh: Undangan, Permohonan
            $table->text('deskripsi')->nullable();       // keterangan opsional
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kategori_surat');
    }
};
