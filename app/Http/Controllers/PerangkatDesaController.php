<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PerangkatDesaService;

class PerangkatDesaController extends Controller
{
    protected $service;

    public function __construct(PerangkatDesaService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $perangkat = $this->service->getAll();
        return view('perangkat.index', compact('perangkat'));
    }

    public function show($id)
    {
        $data = $this->service->getById($id);
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

        $this->service->create($validated);

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

        $this->service->update($id, $validated);

        return redirect()->route('perangkat.index')->with('success', 'Data perangkat desa berhasil diperbarui');
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return redirect()->route('perangkat.index')->with('success', 'Data perangkat desa berhasil dihapus');
    }
}
