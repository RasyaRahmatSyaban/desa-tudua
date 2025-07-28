<?php

namespace App\Services;

use App\Models\Media;

class MediaService
{
    public function getAll()
    {
        return Media::select('id', 'nama', 'tipe', 'deskripsi', 'thumbnail')->get();
    }
    public function getPaginated($perPage = 10)
    {
        return Media::select('id', 'nama', 'tipe', 'deskripsi', 'thumbnail')->latest()->paginate($perPage);
    }

    public function getById($id)
    {
        return Media::select('id', 'nama', 'tipe', 'deskripsi', 'thumbnail')->findOrFail($id);
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