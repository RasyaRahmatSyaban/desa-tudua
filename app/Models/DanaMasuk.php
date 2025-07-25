<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DanaMasuk extends Model
{
    protected $table = 'danamasuk';

    protected $fillable = [
        'tahun', 'bulan', 'jumlah', 'sumber', 'keterangan'
    ];
}
