<?php

namespace App\Services;

use App\Models\Penduduk;

class PendudukService
{
    public function getAll()
    {
        return Penduduk::select('id', 'nama', 'nik', 'alamat', 'tanggal_lahir', 'jenis_kelamin', 'agama', 'id_kepalakeluarga')->latest()->paginate(10);
    }

    public function getById($id)
    {
        return Penduduk::select('id', 'nama', 'nik', 'alamat', 'tanggal_lahir', 'jenis_kelamin', 'agama', 'id_kepalakeluarga')->findOrFail($id);
    }
    public function create($data)
    {
        return Penduduk::create($data);
    }
    public function update($id, array $data)
    {
        $penduduk = Penduduk::findOrFail($id);

        $penduduk->update($data);
        return $penduduk;
    }
    public function delete($id)
    {
        return Penduduk::destroy($id);
    }

}