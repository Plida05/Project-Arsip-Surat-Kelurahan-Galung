<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PengajuanSurat extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_surat';

    protected $fillable = [
        'user_id',
        'jenis_surat_id',
        'admin_id',
        'nomor_pengajuan',
        'tujuan',
        'keperluan',
        'file_berkas',
        'file_surat_jadi',
        'nomor_surat',
        'alasan_tolak',
        'status',
        'verified_at',
    ];

    protected function casts(): array
    {
        return [
            'file_berkas' => 'array',
            'verified_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function jenisSurat(): BelongsTo
    {
        return $this->belongsTo(JenisSurat::class, 'jenis_surat_id');
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function riwayats(): HasMany
    {
        return $this->hasMany(RiwayatStatus::class, 'pengajuan_id')->orderBy('created_at', 'desc');
    }

    /**
     * Helper to get status color badge
     */
    public function getStatusBadgeAttribute(): array
    {
        return match($this->status) {
            'diajukan' => ['label' => 'Diajukan', 'bg' => 'bg-amber-100', 'text' => 'text-amber-800', 'border' => 'border-amber-200'],
            'diproses' => ['label' => 'Sedang Diproses', 'bg' => 'bg-blue-100', 'text' => 'text-blue-800', 'border' => 'border-blue-200'],
            'disetujui' => ['label' => 'Disetujui', 'bg' => 'bg-emerald-100', 'text' => 'text-emerald-800', 'border' => 'border-emerald-200'],
            'ditolak' => ['label' => 'Ditolak', 'bg' => 'bg-rose-100', 'text' => 'text-rose-800', 'border' => 'border-rose-200'],
            'selesai' => ['label' => 'Selesai & Siap Diunduh', 'bg' => 'bg-teal-100', 'text' => 'text-teal-800', 'border' => 'border-teal-200'],
            default => ['label' => ucfirst($this->status), 'bg' => 'bg-slate-100', 'text' => 'text-slate-800', 'border' => 'border-slate-200'],
        };
    }
}
