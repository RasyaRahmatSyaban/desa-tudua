<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SuratKeluarService;

class SuratKeluarController extends Controller
{
    protected $suratKeluarService;

    public function __construct(SuratKeluarService $suratKeluarService)
    {
        $this->suratKeluarService = $suratKeluarService;
    }

    public function index(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:100',
        ]);

        $hasFilter = $request->filled('search');

        if ($hasFilter) {
            $suratKeluar = $this->suratKeluarService->getFiltered($request);
        } else {
            $suratKeluar = $this->suratKeluarService->getPaginated();
        }

        $user = auth()->user();
        if ($user) {
            return view('admin.surat-keluar.index', compact('suratKeluar'));
        } else {
            return view('suratKeluar.index', compact('suratKeluar'));
        }
    }

    public function show($id)
    {
        $data = $this->suratKeluarService->getById($id);
        return view('suratkeluar.show', compact('data'));
    }
    public function create()
    {
        return view('admin.surat-keluar.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:100|unique:surat_keluar,nomor_surat',
            'penerima' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'tanggal_kirim' => 'required|date',
            'file' => 'required|file|mimes:pdf,doc,docs,docx|max:5120',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $path = $file->storeAs('uploads/surat-keluar', $originalName, 'public');
            $validated['file'] = $path;
        }

        $this->suratKeluarService->create($validated);

        return redirect()->route('admin.surat-keluar.index')->with('success', 'Data surat keluar berhasil ditambahkan');
    }
    public function edit($id)
    {
        $suratKeluar = $this->suratKeluarService->getById($id);
        return view('admin.surat-keluar.edit', compact('suratKeluar'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:100|unique:surat_keluar,nomor_surat,' . $request->id,
            'penerima' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'tanggal_kirim' => 'required|date',
            'file' => 'required|file|mimes:pdf,doc,docs,docx|max:5120',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName(); // nama asli file
            $path = $file->storeAs('uploads/surat-masuk', $originalName, 'public');
            $validated['file'] = $path;
        }

        $this->suratKeluarService->update($id, $validated);

        return redirect()->route('admin.surat-keluar.index')->with('success', 'Data surat keluar berhasil diperbarui');
    }

    public function destroy($id)
    {
        $this->suratKeluarService->delete($id);
        return redirect()->route('admin.surat-keluar.index')->with('success', 'Data surat keluar berhasil dihapus');
    }
}
