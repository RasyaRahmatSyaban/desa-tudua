<?php

namespace App\Services;

use App\Models\DanaMasuk;
use Illuminate\Http\Request;

class DanaMasukService
{
    public function getAll()
    {
        return DanaMasuk::select('id', 'tahun', 'bulan', 'jumlah', 'sumber', 'keterangan')->get();
    }
    public function getPaginated($perPage = 10)
    {
        return DanaMasuk::select('id', 'tahun', 'bulan', 'jumlah', 'sumber', 'keterangan')->latest()->paginate($perPage);
    }
    public function getFiltered(Request $request)
    {
        return DanaMasuk::select('id', 'tahun', 'bulan', 'jumlah', 'sumber', 'keterangan')
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('tahun', 'like', '%' . $request->search . '%');
            })->when($request->filled('bulan'), function ($query) use ($request){
                $query->where('bulan', $request->bulan);
            })->when($request->filled('tahun'), function ($query) use ($request){
                $query->where('tahun', $request->tahun);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();
    }

    public function getById($id)
    {
        return DanaMasuk::select('id', 'tahun', 'bulan', 'jumlah', 'sumber', 'keterangan')->findOrFail($id);
    }
    public function create($data)
    {
        return DanaMasuk::create($data);
    }
    public function update($id, array $data)
    {
        $danaMasuk = DanaMasuk::findOrFail($id);

        $danaMasuk->update($data);
        return $danaMasuk;
    }
    public function delete($id)
    {
        return DanaMasuk::destroy($id);
    }

}