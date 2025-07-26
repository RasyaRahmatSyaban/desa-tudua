<?php

namespace App\Services;

use App\Models\DanaMasuk;

class DanaMasukService
{
    public function getAll()
    {
        return DanaMasuk::select('id', 'tahun', 'bulan', 'jumlah', 'sumber', 'keterangan')->latest()->paginate(10);
    }

    public function getById($id)
    {
        return DanaMasuk::select('id', 'tahun', 'bulan', 'jumlah', 'sumber', 'keterangan')->findOrFail($id);
    }
    public function create($data)
    {
        return DanaMasuk::create($data);
    }
    public function update($id, array $data)
    {
        $danaMasuk = DanaMasuk::findOrFail($id);

        $danaMasuk->update($data);
        return $danaMasuk;
    }
    public function delete($id)
    {
        return DanaMasuk::destroy($id);
    }

}