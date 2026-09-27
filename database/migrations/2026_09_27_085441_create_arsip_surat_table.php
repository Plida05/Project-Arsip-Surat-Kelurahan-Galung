<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('arsip_surat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('kategori_surat')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->enum('jenis', ['masuk', 'keluar'])->default('masuk');
            $table->string('nomor_surat');
            $table->string('perihal');
            $table->string('asal')->nullable();       // diisi kalau surat masuk
            $table->string('tujuan')->nullable();     // diisi kalau surat keluar
            $table->date('tanggal_surat');
            $table->date('tanggal_terima')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('file_surat')->nullable(); // path file PDF
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('arsip_surat');
    }
};
