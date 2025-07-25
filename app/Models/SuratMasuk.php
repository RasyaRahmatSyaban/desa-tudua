<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    protected $table = 'suratmasuk';

    protected $fillable = [
        'nomor_surat', 'pengirim', 'perihal', 'tanggal_terima', 'file'
    ];
}
