<?php

namespace App\Services;

use App\Models\Media;
use Illuminate\Http\Request;

class MediaService
{
    public function getAll()
    {
        return Media::select('id', 'nama', 'tipe', 'file', 'deskripsi', 'thumbnail')->get();
    }
    public function getPaginated($perPage = 12)
    {
        return Media::select('id', 'nama', 'tipe', 'file', 'deskripsi', 'thumbnail')->latest()->paginate($perPage);
    }
    public function getFiltered(Request $request)
    {
        return Media::select('id', 'nama', 'tipe', 'file', 'deskripsi', 'thumbnail')
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('nama', 'like', '%' . $request->search . '%');
            })
            ->when($request->filled('tipe'), function ($query) use ($request) {
                $query->where('tipe', $request->tipe);
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();
    }
    public function getById($id)
    {
        return Media::select('id', 'nama', 'tipe', 'file', 'deskripsi', 'thumbnail')->findOrFail($id);
    }
    public function create($data)
    {
        return Media::create($data);
    }
    public function update($id, array $data)
    {
        $media = Media::findOrFail($id);

        $media->update($data);
        return $media;
    }
    public function delete($id)
    {
        return Media::destroy($id);
    }

}