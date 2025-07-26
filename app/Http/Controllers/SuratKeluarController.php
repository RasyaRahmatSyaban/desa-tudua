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

    public function index()
    {
        $suratKeluar = $this->suratKeluarService->getAll();
        $user = auth()->user();
        if($user){
            return view('admin.surat-keluar.index', compact('suratKeluar'));
        }else{
            return view('suratKeluar.index', compact('suratKeluar'));
        }
    }

    public function show($id)
    {
        $data = $this->suratKeluarService->getById($id);
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

        $this->suratKeluarService->create($validated);

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

        $this->suratKeluarService->update($id, $validated);

        return redirect()->route('suratkeluar.index')->with('success', 'Data surat keluar berhasil diperbarui');
    }

    public function destroy($id)
    {
        $this->suratKeluarService->delete($id);
        return redirect()->route('suratkeluar.index')->with('success', 'Data surat keluar berhasil dihapus');
    }
}
