<?php

namespace App\Services;

use App\Models\SuratMasuk;


class SuratMasukService
{
    public function getAll()
    {
        return SuratMasuk::select('id', 'nomor_surat', 'pengirim', 'perihal', 'tanggal_terima', 'file')->get();
    }
    public function getPaginated($perPage = 10)
    {
        return SuratMasuk::select('id', 'nomor_surat', 'pengirim', 'perihal', 'tanggal_terima', 'file')->latest()->paginate($perPage);
    }

    public function getById($id)
    {
        return SuratMasuk::select('id', 'nomor_surat', 'pengirim', 'perihal', 'tanggal_terima', 'file')->findOrFail($id);
    }
    public function create($data)
    {
        return SuratMasuk::create($data);
    }
    public function update($id, array $data)
    {
        $suratMasuk = SuratMasuk::findOrFail($id);

        $suratMasuk->update($data);
        return $suratMasuk;
    }
    public function delete($id)
    {
        return SuratMasuk::destroy($id);
    }

}