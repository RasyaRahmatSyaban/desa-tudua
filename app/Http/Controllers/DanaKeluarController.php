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

    public function index()
    {
        $danaKeluar = $this->danaKeluarService->getAll();
        $user = auth()->user();
        if($user){
            return view('admin.dana-keluar.index', compact('danaKeluar'));
        }else{
            return view('dana-desa.index', compact('danaKeluar'));
        }
        // $items = $this->danaKeluarService->getAll();
        // return view('danakeluar.index', compact('items'));
    }

    public function show($id)
    {
        $item = $this->danaKeluarService->getById($id);
        return view('danakeluar.show', compact('item'));
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
        return redirect()->route('danakeluar.index')->with('success', 'Dana keluar berhasil ditambahkan');
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
        return redirect()->route('danakeluar.index')->with('success', 'Dana keluar berhasil diperbarui');
    }

    public function destroy($id)
    {
        $this->danaKeluarService->delete($id);
        return redirect()->route('danakeluar.index')->with('success', 'Dana keluar berhasil dihapus');
    }
}
