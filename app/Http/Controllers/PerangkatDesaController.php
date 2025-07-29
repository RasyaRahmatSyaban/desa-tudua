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

    public function index(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:100',
        ]);        

        $hasFilter = $request->filled('search');

        if($hasFilter){
            $perangkatDesa = $this->perangkatDesaService->getFiltered($request);
        }else{
            $perangkatDesa = $this->perangkatDesaService->getPaginated();
        }
        $user = auth()->user();
        if($user){
            return view('admin.perangkat-desa.index', compact('perangkatDesa'));
        }else{
            return view('perangkat-desa.index', compact('perangkatDesa'));
        }
    }

    public function show($id)
    {
        $data = $this->perangkatDesaService->getById($id);
        return view('perangkat-desa.show', compact('data'));
    }
    public function create()
    {
        return view('admin.perangkat-desa.create');   
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:30|unique:perangkat_desa,nip',
            'jabatan' => 'required|string|max:100',
            'foto' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $originalName = $file->getClientOriginalName();
            $path = $file->storeAs('uploads/perangkat-desa', $originalName, 'public');
            $validated['foto'] = $path;
        }

        $this->perangkatDesaService->create($validated);

        return redirect()->route('admin.perangkat-desa.index')->with('success', 'Data perangkat desa berhasil ditambahkan');
    }
    public function edit($id)
    {
        $perangkatDesa = $this->perangkatDesaService->getById($id);
        return view('admin.perangkat-desa.edit', compact('perangkatDesa'));   
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:30|unique:perangkat_desa,nip',
            'jabatan' => 'required|string|max:100',
            'foto' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $originalName = $file->getClientOriginalName();
            $path = $file->storeAs('uploads/perangkat-desa', $originalName, 'public');
            $validated['foto'] = $path;
        }

        $this->perangkatDesaService->update($id, $validated);

        return redirect()->route('admin.perangkat-desa.index')->with('success', 'Data perangkat desa berhasil diperbarui');
    }

    public function destroy($id)
    {
        $this->perangkatDesaService->delete($id);
        return redirect()->route('admin.perangkat-desa.index')->with('success', 'Data perangkat desa berhasil dihapus');
    }
}
