<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArsipSurat extends Model
{
    protected $table = 'arsip_surat';
    protected $guarded = ['id'];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriSurat::class, 'kategori_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function generateNomorSurat(?int $kategoriId): string
    {
        $tahun = date('Y');
        $kodeKlasifikasi = '000';
        $kodeKelurahan = 'KEL-GLG';

        if ($kategoriId) {
            $kategori = KategoriSurat::find($kategoriId);
            if ($kategori && $kategori->kode_klasifikasi) {
                $kodeKlasifikasi = $kategori->kode_klasifikasi;
            }
        }

        // Hitung urutan untuk kombinasi tahun + kode klasifikasi
        $urutan = self::where('nomor_surat', 'like', "$kodeKlasifikasi/%/$kodeKelurahan/$tahun")
            ->count() + 1;

        $urutanPadded = str_pad($urutan, 3, '0', STR_PAD_LEFT);

        return "$kodeKlasifikasi/$urutanPadded/$kodeKelurahan/$tahun";
    }
}
