<?php

namespace App\Services;

use App\Models\KepalaKeluarga;

class KepalaKeluargaService
{
    public function getAll()
    {
        return KepalaKeluarga::select('id', 'nama', 'nik')->latest()->get();
    }

    public function getById($id)
    {
        return KepalaKeluarga::select('id', 'nama', 'nik')->findOrFail($id);
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

}