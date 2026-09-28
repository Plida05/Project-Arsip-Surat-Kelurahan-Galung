<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ArsipSurat extends Model
{
    use LogsActivity, SoftDeletes;

    protected $table = 'arsip_surat';
    protected $guarded = ['id'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn (string $eventName) => match ($eventName) {
                'created' => 'Membuat arsip surat baru',
                'updated' => 'Mengubah arsip surat',
                'deleted' => 'Menghapus arsip surat',
                'restored' => 'Memulihkan arsip surat',
                default => $eventName,
            });
    }

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

        $urutan = self::withTrashed()
            ->where('nomor_surat', 'like', "$kodeKlasifikasi/%/$kodeKelurahan/$tahun")
            ->count() + 1;

        $urutanPadded = str_pad($urutan, 3, '0', STR_PAD_LEFT);

        return "$kodeKlasifikasi/$urutanPadded/$kodeKelurahan/$tahun";
    }
}
