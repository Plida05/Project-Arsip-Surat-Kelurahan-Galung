<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriSurat extends Model
{
    protected $table = 'kategori_surat';
    protected $guarded = ['id'];

    public function arsipSurats(): HasMany
    {
        return $this->hasMany(ArsipSurat::class, 'kategori_id');
    }
}
