<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    protected $table = 'surat_keluar';

    protected $fillable = [
        'nomor_surat',
        'penerima',
        'perihal',
        'tanggal_kirim',
        'file'
    ];

    protected $casts = [
        'tanggal_kirim' => 'datetime',
    ];
}
