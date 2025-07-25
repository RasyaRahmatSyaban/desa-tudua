<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penduduk extends Model
{
    protected $table = 'penduduk';

    protected $fillable = [
        'nama', 'nik', 'alamat', 'tanggalLahir', 'jenisKelamin', 'agama', 'id_kepalakeluarga'
    ];

    public function kepalaKeluarga(): BelongsTo
    {
        return $this->belongsTo(Kepalakeluarga::class, 'id_kepalakeluarga');
    }
}
