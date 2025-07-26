<?php

namespace App\Http\Controllers;

use App\Services\KepalaKeluargaService;
use Illuminate\Http\Request;

class KepalaKeluargaController extends Controller
{
    protected $kepalaKeluargaService;

    public function __construct(KepalaKeluargaService $kepalaKeluargaService)
    {
        $this->kepalaKeluargaService = $kepalaKeluargaService;
    }

    public function index()
    {
        $kepalaKeluarga = $this->kepalaKeluargaService->getAll();
        $user = auth()->user();
        if($user){
            return view('admin.kepala-keluarga.index', compact('kepalaKeluarga'));
        }else{            
            return view('kepalakeluarga.index', compact('items'));
        }
    }

    public function show($id)
    {
        $item = $this->kepalaKeluargaService->getById($id);
        return view('kepalakeluarga.show', compact('item'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'nik' => 'required|string|max:50',
        ]);

        $this->kepalaKeluargaService->create($validated);
        return redirect()->route('kepalakeluarga.index')->with('success', 'Data kepala keluarga ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'nik' => 'required|string|max:50',
        ]);

        $this->kepalaKeluargaService->update($id, $validated);
        return redirect()->route('kepalakeluarga.index')->with('success', 'Data kepala keluarga diperbarui');
    }

    public function destroy($id)
    {
        $this->kepalaKeluargaService->delete($id);
        return redirect()->route('kepalakeluarga.index')->with('success', 'Data kepala keluarga dihapus');
    }
}
