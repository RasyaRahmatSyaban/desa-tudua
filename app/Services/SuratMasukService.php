<?php

namespace App\Services;

use App\Models\SuratMasuk;
use Illuminate\Http\Request;


class SuratMasukService
{
    public function getAll()
    {
        return SuratMasuk::select('id', 'nomor_surat', 'pengirim', 'perihal', 'tanggal_terima', 'file')->get();
    }
    public function getPaginated($perPage = 10)
    {
        return SuratMasuk::select('id', 'nomor_surat', 'pengirim', 'perihal', 'tanggal_terima', 'file')->latest()->paginate($perPage);
    }
    public function getFiltered(Request $request)
    {
        return SuratMasuk::select('id', 'nomor_surat', 'pengirim', 'perihal', 'tanggal_terima', 'file')
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('nomor_surat', 'like', '%' . $request->search . '%')
                    ->orWhere('pengirim', 'like', '%' . $request->search . '%')
                    ->orWhere('perihal', 'like', '%' . $request->search . '%');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();
    }

    public function getById($id)
    {
        return SuratMasuk::select('id', 'nomor_surat', 'pengirim', 'perihal', 'tanggal_terima', 'file')->findOrFail($id);
    }
    public function create($data)
    {
        return SuratMasuk::create($data);
    }
    public function update($id, array $data)
    {
        $suratMasuk = SuratMasuk::findOrFail($id);

        $suratMasuk->update($data);
        return $suratMasuk;
    }
    public function delete($id)
    {
        return SuratMasuk::destroy($id);
    }

}