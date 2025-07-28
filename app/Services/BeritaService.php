<?php

namespace App\Services;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaService
{
    public function getAll()
    {
        return Berita::select('id', 'foto', 'judul', 'isi', 'tanggal_terbit', 'penulis', 'status', 'created_at')->get();
    }
    public function getPaginated($perPage = 10)
    {
        return Berita::select('id', 'foto', 'judul', 'isi', 'tanggal_terbit', 'penulis', 'status', 'created_at')->latest()->paginate($perPage);
    }

    public function getFiltered(Request $request)
    {
        return Berita::select('id', 'foto', 'judul', 'isi', 'tanggal_terbit', 'penulis', 'status', 'created_at')
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('judul', 'like', '%' . $request->search . '%');
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();
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