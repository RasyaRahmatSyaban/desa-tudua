<?php

namespace App\Services;

use App\Models\Berita;

class BeritaService
{
    public function getAll()
    {
        return Berita::select('id', 'foto', 'judul', 'isi', 'tanggal_terbit', 'penulis', 'status', 'created_at')->latest()->paginate(10);
    }

    public function getById($id)
    {
        return Berita::select('id', 'foto', 'judul', 'isi', 'tanggal_terbit', 'penulis', 'status', 'created_at')->findOrFail($id);
    }
    public function create($data)
    {
        return Berita::create($data);
    }
    public function update($id, array $data)
    {
        $berita = Berita::findOrFail($id);

        $berita->update($data);
        return $berita;
    }
    public function delete($id)
    {
        return Berita::destroy($id);
    }

}