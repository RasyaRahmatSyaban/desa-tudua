<?php

namespace App\Services;

use App\Models\Pengumuman;
use Illuminate\Http\Request;


class PengumumanService
{
    public function getAll()
    {
        return Pengumuman::select('id', 'judul', 'isi', 'status', 'berlaku_hingga')->get();
    }
    public function getPaginated($perPage = 10)
    {
        return Pengumuman::select('id', 'judul', 'isi', 'status', 'berlaku_hingga')->latest()->paginate($perPage);
    }

    public function getFiltered(Request $request)
    {
        return Pengumuman::select('id', 'judul', 'isi', 'status', 'berlaku_hingga')
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
        return Pengumuman::select('id', 'judul', 'isi', 'status', 'berlaku_hingga')->findOrFail($id);
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