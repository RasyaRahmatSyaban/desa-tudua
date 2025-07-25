<?php

namespace App\Http\Controllers;

use App\Services\PelayananService;
use Illuminate\Http\Request;

class PelayananController extends Controller
{
    protected $pelayananService;

    public function __construct(PelayananService $pelayananService)
    {
        $this->pelayananService = $pelayananService;
    }

    public function index()
    {
        $items = $this->pelayananService->getAll();
        return view('pelayanan.index', compact('items'));
    }

    public function show($id)
    {
        $item = $this->pelayananService->getById($id);
        return view('pelayanan.show', compact('item'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'kategori' => 'required|in:Dokumen Identitas,Kependudukan,Pencatatan Sipil',
            'deskripsi' => 'required|string',
            'link_google_form' => 'required|string',
        ]);

        $this->pelayananService->create($validated);
        return redirect()->route('pelayanan.index')->with('success', 'Pelayanan berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'kategori' => 'required|in:Dokumen Identitas,Kependudukan,Pencatatan Sipil',
            'deskripsi' => 'required|string',
            'link_google_form' => 'required|string',
        ]);

        $this->pelayananService->update($id, $validated);
        return redirect()->route('pelayanan.index')->with('success', 'Pelayanan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $this->pelayananService->delete($id);
        return redirect()->route('pelayanan.index')->with('success', 'Pelayanan berhasil dihapus');
    }
}
