<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class KategoriSurat extends Model
{
    use LogsActivity;

    protected $table = 'kategori_surat';
    protected $guarded = ['id'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn (string $eventName) => match ($eventName) {
                'created' => 'Membuat kategori surat baru',
                'updated' => 'Mengubah kategori surat',
                'deleted' => 'Menghapus kategori surat',
                default => $eventName,
            });
    }

    public function arsipSurats(): HasMany
    {
        return $this->hasMany(ArsipSurat::class, 'kategori_id');
    }
}
