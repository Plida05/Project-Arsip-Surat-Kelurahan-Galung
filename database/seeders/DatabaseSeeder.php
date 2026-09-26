<?php

namespace Database\Seeders;

use App\Models\JenisSurat;
use App\Models\PengajuanSurat;
use App\Models\RiwayatStatus;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Users (Admin & Warga)
        $admin = User::firstOrCreate(
            ['username' => 'admin'],
            [
                'nik' => '3201010101900001',
                'nama_lengkap' => 'Admin Pelayanan Kelurahan',
                'email' => 'admin@kelurahan.go.id',
                'password' => Hash::make('admin123'),
                'no_telp' => '081234567890',
                'alamat' => 'Kantor Kelurahan Sukamaju, Jl. Merdeka No. 1',
                'role' => 'admin',
            ]
        );

        $warga1 = User::firstOrCreate(
            ['username' => 'budi'],
            [
                'nik' => '3201010101950002',
                'nama_lengkap' => 'Budi Santoso',
                'email' => 'budi@gmail.com',
                'password' => Hash::make('warga123'),
                'no_telp' => '085712345678',
                'alamat' => 'Jl. Kenanga Blok C No. 4, RT 02/RW 04',
                'role' => 'warga',
            ]
        );

        $warga2 = User::firstOrCreate(
            ['username' => 'siti'],
            [
                'nik' => '3201010102980003',
                'nama_lengkap' => 'Siti Nurhaliza',
                'email' => 'siti@gmail.com',
                'password' => Hash::make('warga123'),
                'no_telp' => '081298765432',
                'alamat' => 'Jl. Melati No. 15, RT 01/RW 03',
                'role' => 'warga',
            ]
        );

        // 2. Seed Jenis Surat
        $jenisSurats = [
            [
                'kode' => 'SKD',
                'nama' => 'Surat Keterangan Domisili',
                'deskripsi' => 'Surat keterangan resmi yang menyatakan bahwa pemohon bertempat tinggal di wilayah kelurahan ini.',
                'persyaratan' => "1. Scan / Foto KTP Asli\n2. Scan / Foto Kartu Keluarga (KK)\n3. Surat Pengantar dari RT/RW setempat",
            ],
            [
                'kode' => 'SKU',
                'nama' => 'Surat Keterangan Usaha',
                'deskripsi' => 'Surat keterangan untuk keperluan izin usaha, pengajuan pinjaman bank, atau bantuan UMKM.',
                'persyaratan' => "1. Scan / Foto KTP Asli\n2. Scan / Foto Kartu Keluarga (KK)\n3. Surat Pengantar RT/RW\n4. Foto Tempat / Kegiatan Usaha",
            ],
            [
                'kode' => 'SKTM',
                'nama' => 'Surat Keterangan Tidak Mampu',
                'deskripsi' => 'Surat keterangan untuk keperluan beasiswa, keringanan biaya pendidikan, atau jaminan kesehatan.',
                'persyaratan' => "1. Scan / Foto KTP Asli\n2. Scan / Foto Kartu Keluarga (KK)\n3. Surat Pengantar RT/RW bermaterai\n4. Foto Rumah Tinggal (Tampak Depan & Ruang Tamu)",
            ],
            [
                'kode' => 'SKCK',
                'nama' => 'Surat Pengantar Catatan Kepolisian (SKCK)',
                'deskripsi' => 'Surat pengantar rekomendasi dari kelurahan untuk pembuatan SKCK di Polsek / Polres.',
                'persyaratan' => "1. Scan / Foto KTP Asli\n2. Scan / Foto Kartu Keluarga (KK)\n3. Scan Akta Kelahiran\n4. Surat Pengantar RT/RW\n5. Pas Foto formal 4x6 latar belakang merah",
            ],
            [
                'kode' => 'SKBM',
                'nama' => 'Surat Keterangan Belum Menikah',
                'deskripsi' => 'Surat keterangan bahwa yang bersangkutan belum pernah melangsungkan perkawinan/pernikahan.',
                'persyaratan' => "1. Scan / Foto KTP Asli\n2. Scan / Foto Kartu Keluarga (KK)\n3. Surat Pengantar RT/RW\n4. Surat Pernyataan Belum Menikah bermaterai 10.000",
            ],
        ];

        foreach ($jenisSurats as $js) {
            JenisSurat::firstOrCreate(['kode' => $js['kode']], $js);
        }

        $skd = JenisSurat::where('kode', 'SKD')->first();
        $sku = JenisSurat::where('kode', 'SKU')->first();

        // 3. Seed Pengajuan Sample
        $pengajuan1 = PengajuanSurat::firstOrCreate(
            ['nomor_pengajuan' => 'REG-20260926-0001'],
            [
                'user_id' => $warga1->id,
                'jenis_surat_id' => $skd->id,
                'admin_id' => null,
                'tujuan' => 'Dinas Kependudukan dan Pencatatan Sipil',
                'keperluan' => 'Pembaruan data kependudukan dan pembuatan dokumen keluarga',
                'file_berkas' => ['sample_ktp.pdf', 'sample_kk.pdf', 'pengantar_rt.jpg'],
                'file_surat_jadi' => null,
                'nomor_surat' => null,
                'status' => 'diajukan',
                'created_at' => now()->subDay(),
            ]
        );

        RiwayatStatus::firstOrCreate(
            ['pengajuan_id' => $pengajuan1->id, 'status_baru' => 'diajukan'],
            [
                'user_id' => $warga1->id,
                'status_lama' => null,
                'keterangan' => 'Permohonan surat berhasil diajukan oleh pemohon via portal online.',
                'created_at' => now()->subDay(),
            ]
        );

        $pengajuan2 = PengajuanSurat::firstOrCreate(
            ['nomor_pengajuan' => 'REG-20260926-0002'],
            [
                'user_id' => $warga2->id,
                'jenis_surat_id' => $sku->id,
                'admin_id' => $admin->id,
                'tujuan' => 'Bank BRI Cabang Sukamaju',
                'keperluan' => 'Pengajuan tambahan modal usaha KUR Warung Kelontong',
                'file_berkas' => ['ktp_siti.pdf', 'kk_siti.pdf', 'foto_usaha.jpg'],
                'file_surat_jadi' => 'surat_sku_resmi_siti.pdf',
                'nomor_surat' => '503/SKU/09/2026',
                'status' => 'selesai',
                'verified_at' => now()->subHours(5),
                'created_at' => now()->subDays(2),
            ]
        );

        RiwayatStatus::firstOrCreate(
            ['pengajuan_id' => $pengajuan2->id, 'status_baru' => 'diajukan'],
            [
                'user_id' => $warga2->id,
                'status_lama' => null,
                'keterangan' => 'Permohonan surat berhasil diajukan oleh pemohon via portal online.',
                'created_at' => now()->subDays(2),
            ]
        );

        RiwayatStatus::firstOrCreate(
            ['pengajuan_id' => $pengajuan2->id, 'status_baru' => 'diproses'],
            [
                'user_id' => $admin->id,
                'status_lama' => 'diajukan',
                'keterangan' => 'Dokumen kelengkapan sedang diverifikasi oleh admin kelurahan.',
                'created_at' => now()->subDay(),
            ]
        );

        RiwayatStatus::firstOrCreate(
            ['pengajuan_id' => $pengajuan2->id, 'status_baru' => 'selesai'],
            [
                'user_id' => $admin->id,
                'status_lama' => 'diproses',
                'keterangan' => 'Surat Keterangan Usaha No: 503/SKU/09/2026 telah disetujui, ditandatangani dan siap diunduh.',
                'created_at' => now()->subHours(5),
            ]
        );
    }
}
