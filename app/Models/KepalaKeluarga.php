<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KepalaKeluarga extends Model
{
    protected $table = 'kepala_keluarga';

    protected $fillable = [
        'nama', 'nomor_kk', 'nik'
    ];

    public function penduduk(): HasMany
    {
        return $this->hasMany(Penduduk::class, 'id_kepalakeluarga');
    }
}
