<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SuratKeluarService;

class SuratKeluarController extends Controller
{
    protected $service;

    public function __construct(SuratKeluarService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $suratKeluar = $this->service->getAll();
        return view('suratkeluar.index', compact('suratKeluar'));
    }

    public function show($id)
    {
        $data = $this->service->getById($id);
        return view('suratkeluar.show', compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:100',
            'penerima' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'tanggal_kirim' => 'required|date',
            'file' => 'nullable|url',
        ]);

        $this->service->create($validated);

        return redirect()->route('suratkeluar.index')->with('success', 'Data surat keluar berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:100',
            'penerima' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'tanggal_kirim' => 'required|date',
            'file' => 'nullable|url',
        ]);

        $this->service->update($id, $validated);

        return redirect()->route('suratkeluar.index')->with('success', 'Data surat keluar berhasil diperbarui');
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return redirect()->route('suratkeluar.index')->with('success', 'Data surat keluar berhasil dihapus');
    }
}
