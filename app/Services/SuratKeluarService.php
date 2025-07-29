<?php

namespace App\Services;

use App\Models\SuratKeluar;
use Illuminate\Http\Request;


class SuratKeluarService
{
    public function getAll()
    {
        return SuratKeluar::select('id', 'nomor_surat', 'penerima', 'perihal', 'tanggal_kirim', 'file')->get();
    }
    public function getPaginated($perPage = 10)
    {
        return SuratKeluar::select('id', 'nomor_surat', 'penerima', 'perihal', 'tanggal_kirim', 'file')->latest()->paginate($perPage);
    }
    public function getFiltered(Request $request)
    {
        return SuratMasuk::select('id', 'nomor_surat', 'penerima', 'perihal', 'tanggal_kirim', 'file')
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('nomor_surat', 'like', '%' . $request->search . '%')
                    ->orWhere('penerima', 'like', '%' . $request->search . '%')
                    ->orWhere('perihal', 'like', '%' . $request->search . '%');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();
    }

    public function getById($id)
    {
        return SuratKeluar::select('id', 'nomor_surat', 'penerima', 'perihal', 'tanggal_kirim', 'file')->findOrFail($id);
    }
    public function create($data)
    {
        return SuratKeluar::create($data);
    }
    public function update($id, array $data)
    {
        $suratKeluar = SuratKeluar::findOrFail($id);

        $suratKeluar->update($data);
        return $suratKeluar;
    }
    public function delete($id)
    {
        return SuratKeluar::destroy($id);
    }

}