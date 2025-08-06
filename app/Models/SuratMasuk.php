<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    protected $table = 'surat_masuk';

    protected $fillable = [
        'nomor_surat',
        'pengirim',
        'perihal',
        'tanggal_terima',
        'file'
    ];
    protected $casts = [
        'tanggal_terima' => 'datetime',
    ];
}
