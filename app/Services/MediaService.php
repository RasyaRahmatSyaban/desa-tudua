<?php

namespace App\Services;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    public function create($data, $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $filename = now()->format('Ymd_His') . '_' . $originalName;
            $path = $file->storeAs('uploads/media', $filename, 'public');

            $data['file'] = $path;
        }
        return Media::create($data);
    }
    public function update($id, array $data, $request)
    {
        $media = Media::findOrFail($id);

        if ($request->hasFile('file')) {
            if ($media->file && Storage::disk('public')->exists($media->file)) {
                Storage::disk('public')->delete($media->file);
            }
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $filename = now()->format('Ymd_His') . '_' . $originalName;

            $path = $file->storeAs('uploads/media', $filename, 'public');
            $data['file'] = $path;
        }

        $media->update($data);
        return $media;
    }
    public function delete($id)
    {
        $media = $this->getById($id);

        if ($media->file && Storage::disk('public')->exists($media->file)) {
            Storage::disk('public')->delete($media->file);
        }
        return $media->delete();
    }

}