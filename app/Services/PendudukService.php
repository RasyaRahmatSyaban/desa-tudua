<?php

namespace App\Services;

use App\Models\Penduduk;
use Illuminate\Http\Request;

class PendudukService
{
    public function getAll()
    {
        return Penduduk::select('id', 'nama', 'nik', 'alamat', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'agama', 'id_kepalakeluarga')->latest()->paginate(10);
    }

    public function getFiltered(Request $request)
    {
        return Penduduk::with('kepalaKeluarga')
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('nama', 'like', '%' . $request->search . '%');
            })
            ->when($request->filled('jenis_kelamin'), function ($query) use ($request) {
                $query->where('jenis_kelamin', $request->jenis_kelamin);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();
    }

    public function getById($id)
    {
        return Penduduk::select('id', 'nama', 'nik', 'alamat', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'agama', 'id_kepalakeluarga')->findOrFail($id);
    }
    public function create($data)
    {
        return Penduduk::create($data);
    }
    public function update($id, array $data)
    {
        $penduduk = Penduduk::findOrFail($id);

        $penduduk->update($data);
        return $penduduk;
    }
    public function delete($id)
    {
        return Penduduk::destroy($id);
    }

}