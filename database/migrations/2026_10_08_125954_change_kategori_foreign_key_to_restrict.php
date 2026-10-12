<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('arsip_surat', function (Blueprint $table) {
            $table->dropForeign(['kategori_id']);
            $table->foreign('kategori_id')
                ->references('id')
                ->on('kategori_surat')
                ->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('arsip_surat', function (Blueprint $table) {
            $table->dropForeign(['kategori_id']);
            $table->foreign('kategori_id')
                ->references('id')
                ->on('kategori_surat')
                ->cascadeOnDelete();
        });
    }
};
