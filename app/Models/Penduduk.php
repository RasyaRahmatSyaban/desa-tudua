<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penduduk extends Model
{
    protected $table = 'penduduk';

    protected $fillable = [
        'nama', 'nik', 'alamat', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'agama', 'id_kepalakeluarga'
    ];

    public function kepalaKeluarga(): BelongsTo
    {
        return $this->belongsTo(Kepalakeluarga::class, 'id_kepalakeluarga');
    }
}
