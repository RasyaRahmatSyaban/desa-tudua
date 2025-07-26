<?php

namespace App\Services;

use App\Models\PerangkatDesa;


class PerangkatDesaService
{
    public function getAll()
    {
        return PerangkatDesa::select('id', 'nama', 'nip', 'jabatan', 'foto')->latest()->paginate(10);
    }

    public function getById($id)
    {
        return PerangkatDesa::select('id', 'nama', 'nip', 'jabatan', 'foto')->findOrFail($id);
    }
    public function create($data)
    {
        return PerangkatDesa::create($data);
    }
    public function update($id, array $data)
    {
        $perangkatDesa = PerangkatDesa::findOrFail($id);

        $perangkatDesa->update($data);
        return $perangkatDesa;
    }
    public function delete($id)
    {
        return PerangkatDesa::destroy($id);
    }

}