<?php

namespace App\Services;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaService
{
    public function getAll()
    {
        return Berita::select('id', 'foto', 'judul', 'isi', 'tanggal_terbit', 'penulis', 'status', 'created_at')->get();
    }
    public function getPaginated($perPage = 12)
    {
        return Berita::select('id', 'foto', 'judul', 'isi', 'tanggal_terbit', 'penulis', 'status', 'created_at', 'updated_at')->latest()->paginate($perPage);
    }

    public function getPublishedPaginated($perPage = 12)
    {
        return Berita::select('id', 'foto', 'judul', 'isi', 'tanggal_terbit', 'penulis', 'status', 'created_at', 'updated_at')->where('status', 'Dipublikasi')
            ->latest('tanggal_terbit')
            ->paginate($perPage);
    }

    public function getFiltered(Request $request)
    {
        return Berita::select('id', 'foto', 'judul', 'isi', 'tanggal_terbit', 'penulis', 'status', 'created_at', 'updated_at')
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('judul', 'like', '%' . $request->search . '%');
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->when($request->filled('sort') && $request->sort === 'Terlama', function ($query) {
                $query->oldest('tanggal_terbit');
            }, function ($query) {
                $query->latest('tanggal_terbit');
            })
            ->paginate(12)
            ->withQueryString();
    }

    public function getById($id)
    {
        return Berita::select('id', 'foto', 'judul', 'isi', 'tanggal_terbit', 'penulis', 'status', 'created_at')->findOrFail($id);
    }
    public function getRandomBerita($currentId, $limit = 5)
    {
        return Berita::where('id', '!=', $currentId)
            ->where('status', 'Dipublikasi')
            ->inRandomOrder()
            ->limit($limit)
            ->get();
    }

    public function create($data, $request)
    {
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $originalName = $file->getClientOriginalName();
            $filename = now()->format('Ymd_His') . '_' . $originalName;
            $path = $file->storeAs('uploads/berita', $filename, 'public');

            $data['foto'] = $path;
        }

        return Berita::create($data);
    }
    public function update($id, array $data, $request)
    {
        $berita = Berita::findOrFail($id);

        if ($request->hasFile('foto')) {
            if ($berita->foto && Storage::disk('public')->exists($berita->foto)) {
                Storage::disk('public')->delete($berita->foto);
            }
            $file = $request->file('foto');
            $originalName = $file->getClientOriginalName();
            $filename = now()->format('Ymd_His') . '_' . $originalName;

            $path = $file->storeAs('uploads/berita', $filename, 'public');
            $data['foto'] = $path;
        }

        $berita->update($data);
        return $berita;
    }
    public function delete($id)
    {
        $berita = $this->getById($id);

        if ($berita->foto && Storage::disk('public')->exists($berita->foto)) {
            Storage::disk('public')->delete($berita->foto);
        }

        return $berita->delete();
    }

}