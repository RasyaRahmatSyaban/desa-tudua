<?php

namespace App\Services;

use App\Models\KepalaKeluarga;

class KepalaKeluargaService
{
    public function getAll()
    {
        return KepalaKeluarga::select('id', 'nama', 'nik', 'nomor_kk')->get();
    }

    public function getPaginated($perPage = 10)
    {
        return KepalaKeluarga::select('id', 'nama', 'nik', 'nomor_kk')->latest()->paginate($perPage);
    }

    public function getById($id)
    {
        return KepalaKeluarga::select('id', 'nama', 'nik', 'nomor_kk')->findOrFail($id);
    }
    public function getByNik($nik)
    {
        return KepalaKeluarga::select('id', 'nama', 'nik', 'nomor_kk')->findOrFail($nik);
    }
    public function create($data)
    {
        return KepalaKeluarga::create($data);
    }
    public function update($id, array $data)
    {
        $kepalaKeluarga = KepalaKeluarga::findOrFail($id);

        $kepalaKeluarga->update($data);
        return $kepalaKeluarga;
    }
    public function delete($id)
    {
        return KepalaKeluarga::destroy($id);
    }
    public function deleteByNik($nik)
    {
        return KepalaKeluarga::where('nik', $nik)->delete();
    }
}