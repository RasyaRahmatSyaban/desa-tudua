<?php

namespace App\Http\Controllers;

use App\Services\DanaKeluarService;
use Illuminate\Http\Request;

class DanaKeluarController extends Controller
{
    protected $danaKeluarService;

    public function __construct(DanaKeluarService $danaKeluarService)
    {
        $this->danaKeluarService = $danaKeluarService;
    }

    public function index(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:100',
        ]);

        $hasFilter = $request->filled('search') || $request->filled('kategori') || $request->filled('bulan') || $request->filled('tahun');

        if($hasFilter){
            $danaKeluar = $this->danaKeluarService->getFiltered($request);
        }else{
            $danaKeluar = $this->danaKeluarService->getPaginated();
        }

        $bulanMapping = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        foreach ($danaKeluar as $d) {
            $d->nama_bulan = $bulanMapping[$d->bulan] ?? '-';
        }
        $user = auth()->user();
        if($user){
            return view('admin.dana-keluar.index', compact('danaKeluar'));
        }else{
            return view('dana-desa.index', compact('danaKeluar'));
        }
    }

    public function show($id)
    {
        $item = $this->danaKeluarService->getById($id);
        return view('danakeluar.show', compact('item'));
    }
    public function create()
    {
        return view('admin.dana-keluar.create');   
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tahun' => 'required|integer',
            'bulan' => 'required|integer|min:1|max:12',
            'jumlah' => 'required|numeric',
            'kategori' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $this->danaKeluarService->create($validated);
        return redirect()->route('admin.dana-keluar.index')->with('success', 'Dana keluar berhasil ditambahkan');
    }
    public function edit($id)
    {
        $danaKeluar = $this->danaKeluarService->getById($id);
        return view('admin.dana-keluar.edit', compact('danaKeluar'));   
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tahun' => 'required|integer',
            'bulan' => 'required|integer|min:1|max:12',
            'jumlah' => 'required|numeric',
            'kategori' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $this->danaKeluarService->update($id, $validated);
        return redirect()->route('admin.dana-keluar.index')->with('success', 'Dana keluar berhasil diperbarui');
    }

    public function destroy($id)
    {
        $this->danaKeluarService->delete($id);
        return redirect()->route('admin.dana-keluar.index')->with('success', 'Dana keluar berhasil dihapus');
    }
}
