<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SuratMasukService;

class SuratMasukController extends Controller
{
    protected $suratMasukService;

    public function __construct(SuratMasukService $suratMasukService)
    {
        $this->suratMasukService = $suratMasukService;;
    }

    public function index(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:100',
        ]);

        $hasFilter = $request->filled('search');

        if($hasFilter){
            $suratMasuk = $this->suratMasukService->getFiltered($request);
        }else{
            $suratMasuk = $this->suratMasukService->getPaginated();
        }

        $user = auth()->user();
        if($user){
            return view('admin.surat-masuk.index', compact('suratMasuk'));
        }else{
            return view('suratmasuk.index', compact('suratMasuk'));
        }
    }

    public function show($id)
    {
        $data = $this->suratMasukService->getById($id);
        return view('suratmasuk.show', compact('data'));
    }
    public function create()
    {
        return view('admin.surat-masuk.create');   
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:100|unique:surat_masuk,nomor_surat',
            'pengirim' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'tanggal_terima' => 'required|date',
            'file' => 'required|file|mimes:pdf,doc,docs|max:5120',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName(); // nama asli file
            $path = $file->storeAs('uploads/surat-masuk', $originalName, 'public');
            $validated['file'] = $path;
        }

        $this->suratMasukService->create($validated);

        return redirect()->route('admin.surat-masuk.index')->with('success', 'Data surat masuk berhasil ditambahkan');
    }
    public function edit($id)
    {
        $suratMasuk = $this->suratMasukService->getById($id);
        return view('admin.surat-masuk.edit', compact('suratMasuk'));   
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:100|unique:surat_masuk,nomor_surat,' . $request->id,
            'pengirim' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'tanggal_terima' => 'required|date',
            'file' => 'required|file|mimes:pdf,doc,docs|max:5120',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName(); // nama asli file
            $path = $file->storeAs('uploads/surat-masuk', $originalName, 'public');
            $validated['file'] = $path;
        }

        $this->suratMasukService->update($id, $validated);

        return redirect()->route('admin.surat-masuk.index')->with('success', 'Data surat masuk berhasil diperbarui');
    }

    public function destroy($id)
    {
        $this->suratMasukService->delete($id);
        return redirect()->route('admin.surat-masuk.index')->with('success', 'Data surat masuk berhasil dihapus');
    }
}
