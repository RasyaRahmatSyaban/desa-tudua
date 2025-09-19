<?php

namespace App\Services;

use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


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
    public function getFiltered(Request $request, $paginate = true)
    {
        $query = SuratKeluar::select('id', 'nomor_surat', 'penerima', 'perihal', 'tanggal_kirim', 'file')
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('nomor_surat', 'like', '%' . $request->search . '%')
                    ->orWhere('penerima', 'like', '%' . $request->search . '%')
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
        return SuratKeluar::select('id', 'nomor_surat', 'penerima', 'perihal', 'tanggal_kirim', 'file')->findOrFail($id);
    }
    public function create($data, $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $filename = now()->format('Ymd_His') . '_' . $originalName;
            $path = $file->storeAs('uploads/surat-keluar', $filename, 'public');

            $data['file'] = $path;
        }

        return SuratKeluar::create($data);
    }
    public function update($id, array $data, $request)
    {
        $suratKeluar = SuratKeluar::findOrFail($id);

        if ($request->hasFile('file')) {
            if ($suratKeluar->file && Storage::disk('public')->exists($suratKeluar->file)) {
                Storage::disk('public')->delete($suratKeluar->file);
            }
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $filename = now()->format('Ymd_His') . '_' . $originalName;

            $path = $file->storeAs('uploads/surat-keluar', $filename, 'public');
            $data['file'] = $path;
        }

        $suratKeluar->update($data);
        return $suratKeluar;
    }
    public function delete($id)
    {
        $suratKeluar = $this->getById($id);

        if ($suratKeluar->file && Storage::disk('public')->exists($suratKeluar->file)) {
            Storage::disk('public')->delete($suratKeluar->file);
        }
        return $suratKeluar->delete();
    }

}