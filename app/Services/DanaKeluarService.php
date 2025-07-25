<?php

namespace App\Services;

use App\Models\DanaKeluar;

class DanaKeluarService
{
    public function getAll()
    {
        return DanaKeluar::select('id', 'tahun', 'bulan', 'jumlah', 'keterangan')->latest()->get();
    }

    public function getById($id)
    {
        return DanaKeluar::select('id', 'tahun', 'bulan', 'jumlah', 'keterangan')->findOrFail($id);
    }
    public function create($data)
    {
        return DanaKeluar::create($data);
    }
    public function update($id, array $data)
    {
        $danaKeluar = DanaKeluar::findOrFail($id);

        $danaKeluar->update($data);
        return $danaKeluar;
    }
    public function delete($id)
    {
        return DanaKeluar::destroy($id);
    }

}