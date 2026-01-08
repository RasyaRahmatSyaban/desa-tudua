<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'berita';

    protected $fillable = [
        'foto',
        'judul',
        'isi',
        'tanggal_terbit',
        'penulis',
        'status'
    ];
    protected $casts = [
        'tanggal_terbit' => 'datetime',
    ];
}
