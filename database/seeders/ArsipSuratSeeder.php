<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ArsipSurat;
use App\Models\User;
use Carbon\Carbon;

class ArsipSuratSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::first();
        if (!$admin) {
            $this->command->warn('User admin belum ada. Jalankan make:filament-user dulu.');
            return;
        }

        $data = [
            // SURAT MASUK
            [
                'kategori_id' => 1, 'user_id' => $admin->id, 'jenis' => 'masuk',
                'nomor_surat' => '005/UND/DP/2026', 'perihal' => 'Undangan Rapat Koordinasi RT/RW',
                'asal' => 'Dinas Pendidikan Kota', 'tujuan' => null,
                'tanggal_surat' => '2026-09-15', 'tanggal_terima' => '2026-09-17',
                'keterangan' => 'Rapat tanggal 20 September 2026',
            ],
            [
                'kategori_id' => 2, 'user_id' => $admin->id, 'jenis' => 'masuk',
                'nomor_surat' => '010/PRM/KEC/2026', 'perihal' => 'Permohonan Data Kependudukan',
                'asal' => 'Kecamatan Baruga', 'tujuan' => null,
                'tanggal_surat' => '2026-09-10', 'tanggal_terima' => '2026-09-12',
                'keterangan' => 'Data diminta paling lambat 1 minggu',
            ],
            [
                'kategori_id' => 3, 'user_id' => $admin->id, 'jenis' => 'masuk',
                'nomor_surat' => '015/PBT/DINKES/2026', 'perihal' => 'Pemberitahuan Jadwal Posyandu',
                'asal' => 'Dinas Kesehatan', 'tujuan' => null,
                'tanggal_surat' => '2026-09-05', 'tanggal_terima' => '2026-09-08',
                'keterangan' => 'Posyandu rutin bulanan',
            ],
            [
                'kategori_id' => 4, 'user_id' => $admin->id, 'jenis' => 'masuk',
                'nomor_surat' => '020/EDR/PEMKOT/2026', 'perihal' => 'Edaran Kebersihan Lingkungan',
                'asal' => 'Pemerintah Kota', 'tujuan' => null,
                'tanggal_surat' => '2026-09-01', 'tanggal_terima' => '2026-09-03',
                'keterangan' => 'Program Jumat Bersih',
            ],

            // SURAT KELUAR
            [
                'kategori_id' => 2, 'user_id' => $admin->id, 'jenis' => 'keluar',
                'nomor_surat' => '470/001/KEL-BRG/2026', 'perihal' => 'Permohonan Bantuan Bibit Tanaman',
                'asal' => null, 'tujuan' => 'Dinas Pertanian Kota',
                'tanggal_surat' => '2026-09-18', 'tanggal_terima' => null,
                'keterangan' => 'Untuk program penghijauan kelurahan',
            ],
            [
                'kategori_id' => 5, 'user_id' => $admin->id, 'jenis' => 'keluar',
                'nomor_surat' => '800/002/KEL-BRG/2026', 'perihal' => 'Surat Tugas Monitoring Posyandu',
                'asal' => null, 'tujuan' => 'Staf Kelurahan',
                'tanggal_surat' => '2026-09-20', 'tanggal_terima' => null,
                'keterangan' => 'Tugas monitoring 3 hari',
            ],
            [
                'kategori_id' => 3, 'user_id' => $admin->id, 'jenis' => 'keluar',
                'nomor_surat' => '005/003/KEL-BRG/2026', 'perihal' => 'Pemberitahuan Kegiatan Kerja Bakti',
                'asal' => null, 'tujuan' => 'Seluruh RT/RW',
                'tanggal_surat' => '2026-09-22', 'tanggal_terima' => null,
                'keterangan' => 'Kerja bakti tanggal 25 September',
            ],
            [
                'kategori_id' => 6, 'user_id' => $admin->id, 'jenis' => 'keluar',
                'nomor_surat' => '900/004/KEL-BRG/2026', 'perihal' => 'Laporan Bulanan September 2026',
                'asal' => null, 'tujuan' => 'Camat Baruga',
                'tanggal_surat' => '2026-09-25', 'tanggal_terima' => null,
                'keterangan' => 'Laporan kegiatan kelurahan bulan September',
            ],
            [
                'kategori_id' => 1, 'user_id' => $admin->id, 'jenis' => 'keluar',
                'nomor_surat' => '005/005/KEL-BRG/2026', 'perihal' => 'Undangan Musyawarah Kelurahan',
                'asal' => null, 'tujuan' => 'Ketua RT/RW se-Kelurahan Baruga',
                'tanggal_surat' => '2026-09-26', 'tanggal_terima' => null,
                'keterangan' => 'Musyawarah tanggal 30 September 2026',
            ],
            [
                'kategori_id' => 2, 'user_id' => $admin->id, 'jenis' => 'keluar',
                'nomor_surat' => '470/006/KEL-BRG/2026', 'perihal' => 'Permohonan Perbaikan Jalan Lingkungan',
                'asal' => null, 'tujuan' => 'Dinas Pekerjaan Umum',
                'tanggal_surat' => '2026-09-27', 'tanggal_terima' => null,
                'keterangan' => 'Jalan rusak di RT 03',
            ],
        ];

        foreach ($data as $item) {
            ArsipSurat::create($item);
        }
    }
}
