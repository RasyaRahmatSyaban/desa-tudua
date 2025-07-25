<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelayanan extends Model
{
    protected $table = 'pelayanan';

    protected $fillable = [
        'nama_layanan', 'kategori', 'deskripsi', 'link_google_form'
    ];
}
