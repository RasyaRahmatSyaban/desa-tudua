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

    public function index(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:100',
            'kategori' => 'nullable|in:Dokumen Identitas,Kependudukan,Pencatatan Sipil,Kesejahteraan Sosial,Pendidikan,Lainnya',
        ]);

        $hasFilter = $request->filled('search') || $request->filled('kategori');

        if ($hasFilter) {
            $pelayanans = $this->pelayananService->getFiltered($request);
        } else {
            $pelayanans = $this->pelayananService->getPaginated();
        }
        $user = auth()->user();
        if ($user) {
            return view('admin.pelayanan.index', compact('pelayanans'));
        } else {
            return view('pelayanan', compact('pelayanans'));
        }
    }

    public function show($id)
    {
        $item = $this->pelayananService->getById($id);
        return view('pelayanan.show', compact('item'));
    }
    public function create()
    {
        return view('admin.pelayanan.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'kategori' => 'required|in:Dokumen Identitas,Kependudukan,Pencatatan Sipil,Kesejahteraan Sosial,Pendidikan,Lainnya',
            'deskripsi' => 'required|string',
            'link_google_form' => 'required|string',
        ]);

        $this->pelayananService->create($validated);
        return redirect()->route('admin.pelayanan.index')->with('success', 'Pelayanan berhasil ditambahkan');
    }
    public function edit($id)
    {
        $pelayanan = $this->pelayananService->getById($id);
        return view('admin.pelayanan.edit', compact('pelayanan'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'kategori' => 'required|in:Dokumen Identitas,Kependudukan,Pencatatan Sipil,Kesejahteraan Sosial,Pendidikan,Lainnya',
            'deskripsi' => 'required|string',
            'link_google_form' => 'required|string',
        ]);

        $this->pelayananService->update($id, $validated);
        return redirect()->route('admin.pelayanan.index')->with('success', 'Pelayanan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $this->pelayananService->delete($id);
        return redirect()->route('admin.pelayanan.index')->with('success', 'Pelayanan berhasil dihapus');
    }
}
