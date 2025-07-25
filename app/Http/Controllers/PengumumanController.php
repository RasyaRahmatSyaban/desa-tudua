<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PengumumanService;

class PengumumanController extends Controller
{
    protected $service;

    public function __construct(PengumumanService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $pengumuman = $this->service->getAll();
        return view('pengumuman.index', compact('pengumuman'));
    }

    public function show($id)
    {
        $data = $this->service->getById($id);
        return view('pengumuman.show', compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $this->service->create($validated);

        return redirect()->route('pengumuman.index')->with('success', 'Data pengumuman berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $this->service->update($id, $validated);

        return redirect()->route('pengumuman.index')->with('success', 'Data pengumuman berhasil diperbarui');
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return redirect()->route('pengumuman.index')->with('success', 'Data pengumuman berhasil dihapus');
    }
}
