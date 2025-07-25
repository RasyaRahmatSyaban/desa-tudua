<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    protected $table = 'suratmasuk';

    protected $fillable = [
        'nomorSurat', 'pengirim', 'perihal', 'tanggalTerima', 'file'
    ];
}
