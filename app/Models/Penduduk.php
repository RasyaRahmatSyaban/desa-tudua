<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penduduk extends Model
{
    protected $table = 'penduduk';

    protected $fillable = [
        'nama',
        'nik',
        'nomor_kk',
        'alamat',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'id_kepalakeluarga'
    ];

    public function kepalaKeluarga(): BelongsTo
    {
        return $this->belongsTo(Penduduk::class, 'id_kepalakeluarga');
    }
    public function anggotaKeluarga(): HasMany
    {
        return $this->hasMany(Penduduk::class, 'id_kepalakeluarga');
    }
}
