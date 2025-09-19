<?php

namespace App\Services;

use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


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
    public function getFiltered(Request $request, $paginate = true)
    {
        $query = SuratMasuk::select('id', 'nomor_surat', 'pengirim', 'perihal', 'tanggal_terima', 'file')
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('nomor_surat', 'like', '%' . $request->search . '%')
                    ->orWhere('pengirim', 'like', '%' . $request->search . '%')
                    ->orWhere('perihal', 'like', '%' . $request->search . '%');
            })
            ->latest();

        if ($paginate) {
            return $query->paginate(10)->withQueryString();
        }

        return $query->get();
    }

    public function getById($id)
    {
        return SuratMasuk::select('id', 'nomor_surat', 'pengirim', 'perihal', 'tanggal_terima', 'file')->findOrFail($id);
    }
    public function create($data, $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $filename = now()->format('Ymd_His') . '_' . $originalName;
            $path = $file->storeAs('uploads/surat-masuk', $filename, 'public');

            $data['file'] = $path;
        }
        return SuratMasuk::create($data);
    }
    public function update($id, array $data, $request)
    {
        $suratMasuk = SuratMasuk::findOrFail($id);

        if ($request->hasFile('file')) {
            if ($suratMasuk->file && Storage::disk('public')->exists($suratMasuk->file)) {
                Storage::disk('public')->delete($suratMasuk->file);
            }
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $filename = now()->format('Ymd_His') . '_' . $originalName;

            $path = $file->storeAs('uploads/surat-masuk', $filename, 'public');
            $data['file'] = $path;
        }
        $suratMasuk->update($data);
        return $suratMasuk;
    }
    public function delete($id)
    {
        $suratMasuk = $this->getById($id);

        if ($suratMasuk->file && Storage::disk('public')->exists($suratMasuk->file)) {
            Storage::disk('public')->delete($suratMasuk->file);
        }
        return $suratMasuk->delete();
    }

}