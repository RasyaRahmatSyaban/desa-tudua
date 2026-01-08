<?php

namespace App\Services;

use App\Models\DanaKeluar;
use Illuminate\Http\Request;

class DanaKeluarService
{
    public function getAll()
    {
        return DanaKeluar::select('id', 'tahun', 'bulan', 'jumlah', 'kategori', 'keterangan')->get();
    }
    public function getPaginated($perPage = 10)
    {
        return DanaKeluar::select('id', 'tahun', 'bulan', 'jumlah', 'kategori', 'keterangan')->latest()->paginate($perPage);
    }
    public function getFiltered(Request $request)
    {
        return DanaKeluar::select('id', 'tahun', 'bulan', 'jumlah', 'kategori', 'keterangan')
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('kategori', 'like', '%' . $request->search . '%');
            })->when($request->filled('bulan'), function ($query) use ($request){
                $query->where('bulan', $request->bulan);
            })->when($request->filled('tahun'), function ($query) use ($request){
                $query->where('tahun', $request->tahun);
            })->when($request->filled('kategori'), function ($query) use ($request){
                $query->where('kategori', $request->kategori);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();
    }

    public function getById($id)
    {
        return DanaKeluar::select('id', 'tahun', 'bulan', 'jumlah', 'kategori', 'keterangan')->findOrFail($id);
    }
    public function create($data)
    {
        return DanaKeluar::create($data);
    }
    public function update($id, array $data)
    {
        $danaKeluar = DanaKeluar::findOrFail($id);

        $danaKeluar->update($data);
        return $danaKeluar;
    }
    public function delete($id)
    {
        return DanaKeluar::destroy($id);
    }

}