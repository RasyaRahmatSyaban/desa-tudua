<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PerangkatDesaService;

class PerangkatDesaController extends Controller
{
    protected $perangkatDesaService;

    public function __construct(PerangkatDesaService $perangkatDesaService)
    {
        $this->perangkatDesaService = $perangkatDesaService;
    }

    public function index()
    {
        $perangkatDesa = $this->perangkatDesaService->getAll();
        $user = auth()->user();
        if($user){
            return view('admin.perangkat-desa.index', compact('perangkatDesa'));
        }else{
            return view('perangkat.index', compact('perangkatDesa'));
        }
    }

    public function show($id)
    {
        $data = $this->perangkatDesaService->getById($id);
        return view('perangkat.show', compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|max:30',
            'jabatan' => 'required|string|max:100',
            'foto' => 'nullable|url',
        ]);

        $this->perangkatDesaService->create($validated);

        return redirect()->route('perangkat.index')->with('success', 'Data perangkat desa berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|max:30',
            'jabatan' => 'required|string|max:100',
            'foto' => 'nullable|url',
        ]);

        $this->perangkatDesaService->update($id, $validated);

        return redirect()->route('perangkat.index')->with('success', 'Data perangkat desa berhasil diperbarui');
    }

    public function destroy($id)
    {
        $this->perangkatDesaService->delete($id);
        return redirect()->route('perangkat.index')->with('success', 'Data perangkat desa berhasil dihapus');
    }
}
