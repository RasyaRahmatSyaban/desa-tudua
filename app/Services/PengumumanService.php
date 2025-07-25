<?php

namespace App\Services;

use App\Models\Pengumuman;


class PengumumanService
{
    public function getAll()
    {
        return Pengumuman::select('id', 'judul', 'isi', 'tanggal_mulai', 'tanggal_selesai')->latest()->get();
    }

    public function getById($id)
    {
        return Pengumuman::select('id', 'judul', 'isi', 'tanggal_mulai', 'tanggal_selesai')->findOrFail($id);
    }
    public function create($data)
    {
        return Pengumuman::create($data);
    }
    public function update($id, array $data)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        $pengumuman->update($data);
        return $pengumuman;
    }
    public function delete($id)
    {
        return Pengumuman::destroy($id);
    }

}