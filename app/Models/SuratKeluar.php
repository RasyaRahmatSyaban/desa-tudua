<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    protected $table = 'suratkeluar';

    protected $fillable = [
        'nomorSurat', 'penerima', 'perihal', 'tanggalKirim', 'file'
    ];
}
