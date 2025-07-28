<?php

namespace App\Services;

use App\Models\SuratKeluar;


class SuratKeluarService
{
    public function getAll()
    {
        return SuratKeluar::select('id', 'nomor_surat', 'penerima', 'perihal', 'tanggal_kirim', 'file')->get();
    }
    public function getPaginated($perPage = 10)
    {
        return SuratKeluar::select('id', 'nomor_surat', 'penerima', 'perihal', 'tanggal_kirim', 'file')->latest()->paginate($perPage);
    }

    public function getById($id)
    {
        return SuratKeluar::select('id', 'nomor_surat', 'penerima', 'perihal', 'tanggal_kirim', 'file')->findOrFail($id);
    }
    public function create($data)
    {
        return SuratKeluar::create($data);
    }
    public function update($id, array $data)
    {
        $suratKeluar = SuratKeluar::findOrFail($id);

        $suratKeluar->update($data);
        return $suratKeluar;
    }
    public function delete($id)
    {
        return SuratKeluar::destroy($id);
    }

}