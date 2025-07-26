<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BeritaService;

class BeritaController extends Controller
{
    protected $service;

    public function __construct(BeritaService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $berita = $this->service->getAll();
        $user = auth()->user();
        if($user){
            return view('admin.berita.index', compact('berita'));
        }else{
            return view('berita.index', compact('berita'));
        }
    }

    public function show($id)
    {
        $data = $this->service->getById($id);
        return view('berita.show', compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'foto' => 'nullable|url',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'tanggal_terbit' => 'required|date',
            'penulis' => 'required|string|max:100',
            'status' => 'required|in:Draft,Published',
        ]);

        $this->service->create($validated);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'foto' => 'nullable|url',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'tanggal_terbit' => 'required|date',
            'penulis' => 'required|string|max:100',
            'status' => 'required|in:Draft,Published',
        ]);

        $this->service->update($id, $validated);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui');
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus');
    }
}
