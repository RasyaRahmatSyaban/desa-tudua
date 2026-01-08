<?php

namespace App\Services;

use App\Models\Pelayanan;
use Illuminate\Http\Request;


class PelayananService
{
    public function getAll()
    {
        return Pelayanan::select('id', 'nama_layanan', 'kategori', 'deskripsi', 'link_google_form')->get();
    }
    public function getPaginated($perPage = 10)
    {
        return Pelayanan::select('id', 'nama_layanan', 'kategori', 'deskripsi', 'link_google_form')->latest()->paginate($perPage);
    }
    public function getFiltered(Request $request)
    {
        return Pelayanan::select('id', 'nama_layanan', 'kategori', 'deskripsi', 'link_google_form')
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('nama_layanan', 'like', '%' . $request->search . '%')
                    ->orWhere('kategori', 'like', '%' . $request->search . '%');
            })->when($request->filled('kategori'), function ($query) use ($request) {
                $query->where('kategori', $request->kategori);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();
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