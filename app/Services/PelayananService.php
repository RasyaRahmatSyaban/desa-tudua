<?php

namespace App\Services;

use App\Models\Pelayanan;


class PelayananService
{
    public function getAll()
    {
        return Pelayanan::select('id', 'nama_layanan', 'kategori', 'deskripsi', 'link_google_form')->latest()->paginate(10);
    }

    public function getById($id)
    {
        return Pelayanan::select('id', 'nama_layanan', 'kategori', 'deskripsi', 'link_google_form')->findOrFail($id);
    }
    public function create($data)
    {
        return Pelayanan::create($data);
    }
    public function update($id, array $data)
    {
        $pelayanan = Pelayanan::findOrFail($id);

        $pelayanan->update($data);
        return $pelayanan;
    }
    public function delete($id)
    {
        return Pelayanan::destroy($id);
    }

}