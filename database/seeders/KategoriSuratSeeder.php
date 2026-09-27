<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriSurat;

class KategoriSuratSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['kode' => 'UND', 'nama' => 'Undangan', 'deskripsi' => 'Surat undangan rapat/kegiatan'],
            ['kode' => 'PRM', 'nama' => 'Permohonan', 'deskripsi' => 'Surat permohonan dari pihak lain'],
            ['kode' => 'PBT', 'nama' => 'Pemberitahuan', 'deskripsi' => 'Surat pemberitahuan resmi'],
            ['kode' => 'EDR', 'nama' => 'Edaran', 'deskripsi' => 'Surat edaran'],
            ['kode' => 'TGS', 'nama' => 'Surat Tugas', 'deskripsi' => 'Surat penugasan pegawai'],
            ['kode' => 'LAP', 'nama' => 'Laporan', 'deskripsi' => 'Laporan kegiatan'],
        ];

        foreach ($data as $item) {
            KategoriSurat::create($item);
        }
    }
}
