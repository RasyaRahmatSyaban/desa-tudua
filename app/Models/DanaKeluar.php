<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DanaKeluar extends Model
{
    protected $table = 'danakeluar';

    protected $fillable = [
        'tahun', 'bulan', 'jumlah', 'kategori', 'keterangan'
    ];
}
